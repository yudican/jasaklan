<?php

namespace App\Http\Controllers\Users\Profiles;

use Midtrans\Snap;
use App\Models\User;
use Midtrans\Config;
use App\Models\Referral;
use App\Models\Withdraw;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Jobs\HandleWithdrawBalance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Jobs\HandleProfitReferralDeposit;
use App\Models\Ads;
use App\Models\Alert;
use App\Models\Payment;

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = env("MIDTRANS_SERVER_KEY");
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = env("MIDTRANS_PRODUCTION");
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = env("MIDTRANS_SANITIZED");
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = env("MIDTRANS_IS3DS");
\Midtrans\Config::$overrideNotifUrl = env('MIDTRANS_NOTIF_URL');

class ProfileController extends Controller
{
    public function getUser()
    {
        return optional(auth()->user());
    }

    public function showDashboard()
    {
        return view('users.profiles.dashboard', [
            'user' => $this->getUser(),
            'alert' => Alert::where('status', 1)->first(),
        ]);
    }

    public function showProfile()
    {
        return view('users.profiles.edit', [
            'user' => $this->getUser(),
        ]);
    }

    public function updateProfile(Request $request, User $user)
    {
        if ($user->email != $request->email) {
            $user->email_verified_at = null;
        }

        $user->fill($request->all());

        $user->saveOrFail();

        return back()->with(['status' => 'Sukses mengubah profil']);
    }

    public function showPassword()
    {
        return view('users.profiles.password', [
            'user' => $this->getUser(),
        ]);
    }

    public function updatePassword(Request $request, User $user)
    {
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with(['status' => 'Password lama salah!']);
        }

        $user->fill($request->only('password'));
        $user->saveOrFail();

        return back()->with(['status' => 'Berhasil mengubah password!']);
    }

    public function showReferral()
    {
        return view('users.profiles.referral', [
            'user' => $this->getUser(),
        ]);
    }

    public function showBank()
    {
        $user = $this->getUser();

        return view('users.profiles.bank', [
            'bank' => optional($user->getBank),
            'user' => $user,
        ]);
    }

    public function updateBank(Request $request, User $user)
    {
        $user->getBank()->updateOrCreate($request->only('account_id', 'account_name', 'bank_name', 'branch'));

        return back()->with(['status' => 'Sukses mengubah informasi bank']);
    }

    public function showWallet()
    {
        $user = $this->getUser();
        $transactions = $user->transactions();

        return view('users.profiles.wallet', [
            'user' => $user,
            'transactions' => $transactions->get(),

            'income' => (new Transaction)
                ->getFormattedPrice($transactions
                    ->where([
                        ['type', Transaction::INCOME],
                        ['status', Transaction::SETTLE]
                    ])
                    ->sum('amount')),
            'expenses' => (new Transaction)
                ->getFormattedPrice($transactions
                    ->where([
                        ['type', Transaction::EXPENSES],
                        ['status', Transaction::SETTLE]
                    ])
                    ->sum('amount')),
        ]);
    }

    public function showDeposit()
    {
        return view('users.profiles.deposit', [
            'user' => $this->getUser()
        ]);
    }

    public function createDeposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
        ]);

        if ((int) $request->amount < getSetting('MINIMUM_DEPOSIT')) return back()->withErrors(['status' => 'Minimun deposit adalah ' . getSetting('MINIMUM_DEPOSIT')]);

        $transaction = new Ads();

        $transaction->fill([
            'user_id' => $request->user()->id,
            'category' => 'Credit',
            'status' => 2,
            'description' => 'Deposit',
            'amount' => (int) $request->amount,
        ]);

        $transaction->saveOrFail();

        $payment = new Payment();

        $paymentId = rand();

        $payment->fill([
            'id' => $paymentId,
            'user_id' => $transaction->user_id,
            'transaction_id' => $transaction->id,
            'amount' => $transaction->amount,
            'status' => $transaction->status
        ]);

        $payment->saveOrFail();

        $transactions = [
            "transaction_details" => [
                "order_id"     => $paymentId,
                "gross_amount" => (int) $request->amount
            ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($transactions);


        return back()->with(["snapToken" => $snapToken]);
    }

    public function handleDepositStatus()
    {
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        Payment::where("id", $order_id)->update([
            'status' => $transaction
        ]);

        $payment = Payment::where("id", $order_id)->first();

        Ads::where('id', $payment->transaction_id)->update([
            'status' => 1
        ]);

        if ($transaction == 'settlement') {
            if ($referredBy = Referral::where('user_id', $payment->user_id)->first()) {
                HandleProfitReferralDeposit::dispatch($payment->amount, $referredBy->referred_by_id)->afterCommit();
            }

            // User::where("id", $payment->user_id)->increment('balance', $payment->amount);
        }
    }

    public function createWithdraw(Request $request)
    {
        $user = $this->getUser();

        $request->validate([
            'amount'   => 'required|integer',
            'bank_id'  => 'required|integer',
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, $request->user()->password))
            return back()->withErrors(['status' => 'Password tidak sesuai']);

        if ($request->amount < getSetting('MINIMUM_WITHDRAW')) return back()->withErrors([
            'status' => 'Minimum penarikan adalah ' . (new Transaction)->getFormattedPrice(getSetting('MINIMUM_WITHDRAW')),
        ]);

        if ($user->balance < (int) $request->amount) return back()->withErrors(['status' => 'Saldo kamu tidak cukup']);

        $balance    = $user->balance;
        $newBalance = (int) $balance - (int) $request->amount;

        $transaction = new Ads();
        $withdraw    = new Withdraw();

        $transaction->fill([
            'user_id' => $user->id,
            'type'    => 'debit',
            'status' => 2,
            'description' => 'Withdraw',
            'amount'  => -$request->amount,
        ]);

        $withdraw->fill([
            'user_id' => $user->id,
            'bank_id' => $request->bank_id,
            'amount'  => (int) $request->amount,
        ]);

        $transaction->saveOrFail();
        $withdraw->saveOrFail();

        HandleWithdrawBalance::dispatch($user->id, $newBalance)->afterCommit();

        return redirect(route('user.wallet'));
    }

    public function showWithdraw()
    {
        $user = $this->getUser();

        return view('users.profiles.withdraw', [
            'user' => $user,
            'bank' => $user->getBank()->first()
        ]);
    }
}

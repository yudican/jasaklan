<?php

namespace App\Http\Controllers\Users\Viewers;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
use App\Models\Transaction;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        $revenueToday = $this->getUser()
            ->revenues()
            ->where('is_transferred', false)
            ->whereDay('updated_at', now()->day)
            ->sum('amount');

        return view('users.viewers.revenue', [
            'revenues'      => $this->getUser()->revenues()->paginate(10)->withQueryString(),
            'revenue_today' => $revenueToday,
            'revenue_total' => $this->revenueTotal(),
        ]);
    }

    public function transfer()
    {
        $this->getUser()->increment('balance', $this->revenueTotal());

        $transaction = new Transaction();

        $transaction->fill([
            'user_id' => $this->getUser()->id,
            'type'    => Transaction::INCOME,
            'amount'  => (int) $this->revenueTotal(),
            'status'  => Transaction::SETTLE,
        ]);

        $transaction->saveOrFail();

        $this->getUser()->revenues()->update([
            'is_transferred' => true,
        ]);

        return back()->with(['status' => 'Berhasil transfer penghasilan']);
    }

    public function getUser()
    {
        return auth()->user();
    }

    public function revenueTotal()
    {
        return $this->getUser()->revenues()->where('is_transferred', false)->sum('amount');
    }
}

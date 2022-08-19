<?php

namespace App\Http\Controllers\Users\Viewers;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index()
    {
        return view('users.viewers.ticket', [
            'tickets' => auth()->user()->tickets()->paginate(10),
        ]);
    }

    public function getAsSession(Ads $ads)
    {
        return back()->with(['content' => $ads]);
    }

    public function create(Request $request)
    {
        $ticket = new Ticket();
        $ad = Ads::find($request->ads_id);

        $ticket->fill($request->only('ads_id', 'account_name', 'screenshot'));
        $ticket->name = $ad->title ?? $ad->url;
        $ticket->user_id = auth()->user()->id;
        $ticket->commission = $ad->commission;

        $request->screenshot_akhir->store('images/tickets/proofs', 'public');

        $ticket->screenshot_akhir = $request->screenshot_akhir->hashName();

        $ticket->saveOrFail();

        $ad->amount = $ad->amount - 1;
        $ad->saveOrFail();

        return redirect(route('viewers.ticket.index'))->with(['status' => 'Berhasil mengirim data']);
    }
}

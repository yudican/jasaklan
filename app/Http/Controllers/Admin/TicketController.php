<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
use App\Models\Ticket;
use App\Models\User;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('admins.ticket.index', [
            'tickets' => Ticket::orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function approve(Ticket $ticket)
    {
        $ticket->status = Ticket::APPROVE;

        $ticket->saveOrFail();

        User::where('id', $ticket->user_id)->increment('balance', (int) $ticket->commission);
        Revenue::create([
            'user_id' => $ticket->user_id,
            'ticket_id' => $ticket->id,
            'type' => Revenue::TICKET,
            'amount' => $ticket->commission,
        ]);

        return back();
    }

    public function decline(Ticket $ticket)
    {
        $ticket->status = Ticket::REJECTED;

        $ticket->saveOrFail();

        return back();
    }

    public function download(Ticket $ticket)
    {
        return $ticket->download();
    }
}

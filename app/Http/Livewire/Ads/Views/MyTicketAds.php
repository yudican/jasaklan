<?php

namespace App\Http\Livewire\Ads\Views;

use App\Models\Ticket;
use Livewire\Component;

class MyTicketAds extends Component
{
    public $ticket_id;
    public $notes;
    protected $listeners = ['setTicketId'];
    public function render()
    {
        return view('livewire.ads.views.my-ticket-ads');
    }

    public function setTicketId($id)
    {
        $this->emit('toggleModalReject', 'show');
        $this->ticket_id = $id;
    }

    public function saveReject()
    {
        $ticket = Ticket::find($this->ticket_id);
        $number_of_views = $ticket->getAd->views + 1;
        $dataView = [
            'views' => $number_of_views,
            'status' => $number_of_views == 0 ? 'finish' : 'active',
        ];
        $ticket->getAd()->update($dataView);
        $this->emit('toggleModalReject', 'hide');

        $ticket->update([
            'status' => 'reject',
            'notes' => $this->notes,
        ]);

        $this->ticket_id = null;
        $this->notes = null;
        return $this->emit('showAlert', ['msg' => 'Tiket Berhasil Ditolak']);
    }
}

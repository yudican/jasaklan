<?php

namespace App\Http\Livewire\Ads\Views;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithFileUploads;

class GetTicket extends Component
{
    use WithFileUploads;
    public $ads;
    public $type;
    public $screenshot;
    public $screenshot_akhir;

    public function mount($ads, $type = 'views')
    {
        $this->ads = $ads;
        $this->type = $type;
    }
    public function render()
    {
        return view('livewire.ads.views.get-ticket');
    }

    public function applyTicket()
    {
        $ads = $this->ads;
        $user = auth()->user();
        $data = [
            'ads_id' => $this->ads->id,
            'user_id' => $user->id,
            'name' => $this->ads->title,
            'account_name' => $user->name,
            'commission' => $this->ads->package->price,
            'status' => 'review',
        ];

        if ($this->screenshot) {
            $file = $this->screenshot->store('images/tickets/proofs', 'public');
            $data['screenshot'] = explode('proofs/', $file)[1];
        }
        if ($this->screenshot_akhir) {
            $this->screenshot_akhir->store('images/tickets/proofs', 'public');
            $data['screenshot_akhir'] = explode('proofs/', $file)[1];
        }
        $user->adViews()->attach($ads->id);
        $ads->update([
            'views' => $ads->views - 1,
        ]);

        Ticket::create($data);

        return $this->emit('showAlert', ['msg' => 'Ticket berhasil di ambil', 'redirect' => route('viewers.ticket.index')]);
    }

    public function getAdsImage($image)
    {
        if ($image) {
            return response()->download(storage_path('/app/public/' . $image));
        }
        return $this->emit('showAlertError', ['msg' => 'Gambar tidak ditemukan']);
    }
}

<?php

namespace App\Http\Livewire\Ads\Views;

use App\Models\Ads;
use App\Models\Balance;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ViewVideoDetail extends Component
{
    public $view;
    public function mount($ads_id)
    {
        $view = Ads::find($ads_id);
        $this->view = $view;
        $viewUser = $view->userViews()->where('user_id', auth()->user()->id)->first();
        if ($viewUser) {
            return redirect()->route('viewers.ads.list', ['type' => 'views']);
        }
    }
    public function render()
    {
        return view('livewire.ads.views.view-video-detail');
    }

    public function finishView()
    {
        DB::beginTransaction();
        try {
            $view = Ads::find($this->view->id);
            $user = auth()->user();
            $user->adViews()->attach($view->id);
            Balance::insert([
                [
                    'amount' => $view->package->commission,
                    'category' => 'credit',
                    'description' => "Menonton Iklan $view->title $view->id",
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]);

            $number_of_views = $view->views - 1;
            $dataView = [
                'views' => $number_of_views,
                'status' => $number_of_views == 0 ? 'finish' : 'active',
            ];
            $view->update($dataView);
            DB::commit();
            // return $this->emit('openAdsUrl', $view->url);
            return redirect($view->url);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            DB::rollback();
            return $this->emit('showAlertError', ['msg' => 'Terjadi Kesalahan Saat Menonton Iklan']);
            //throw $th;
        }
    }
}

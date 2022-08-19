<?php

namespace App\Http\Controllers\Users\Advertisers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdvertiserController extends Controller
{

    public function getUser()
    {
        return auth()->user();
    }

    public function dashboard()
    {
        return view('users.advertisers.creates.dashboard');
    }

    // Daftar Iklan
    public function indexView()
    {
        return view('users.advertisers.views.iklan-views', [
            'views' => $this->getUser()->getAds()->where('type', Package::VIEWS)->get()
        ]);
    }

    public function indexSubscribe()
    {
        return view('users.advertisers.views.iklan-subscribe', [
            'subscribes' => $this->getUser()->getAds()->where('type', Package::SUBSCRIBE)->get()
        ]);
    }

    public function indexLike()
    {
        return view('users.advertisers.views.iklan-like', [
            'likes' => $this->getUser()->getAds()->where('type', Package::LIKE)->get()
        ]);
    }

    public function indexKomentar()
    {
        return view('users.advertisers.views.iklan-komentar', [
            'comments' => $this->getUser()->getAds()->where('type', Package::COMMENT)->get()
        ]);
    }

    public function viewsQuestion()
    {
        return view('users.advertisers.views.iklan-view-question');
    }

    public function viewsFollower()
    {
        return view('users.advertisers.views.iklan-follower', [
            'advertises' => $this->getUser()->getAds()->where('type', Package::FOLLOWER)->get()
        ]);
    }

    public function viewsPosting()
    {
        return view('users.advertisers.views.iklan-posting', [
            'posts' => $this->getUser()->getAds()->where('type', Package::POSTING)->get()
        ]);
    }

    public function addQuestion(){
        return view('users.advertisers.creates.iklan-view-question');
    }

}

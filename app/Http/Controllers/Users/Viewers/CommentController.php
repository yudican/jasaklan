<?php

namespace App\Http\Controllers\Users\Viewers;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Package;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('users.viewers.iklan-komentar', [
            'comments' => Ads::where('type', Package::COMMENT)->paginate(10)->withQueryString(),
        ]);
    }
}

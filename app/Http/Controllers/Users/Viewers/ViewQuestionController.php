<?php

namespace App\Http\Controllers\Users\Viewers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewQuestionController extends Controller
{
    public function index()
    {
        return view('users.viewers.iklan-view-question');
    }
}

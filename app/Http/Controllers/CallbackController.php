<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function callback(Request $request)
    {
        if ($request->resultCode == "00") {
            $balance = Balance::where('description', "Deposit#" . $request->reference)->first();
            if ($balance) {
                $balance->update(['status' => 1]);
            }
        } else if ($request->resultCode == "01") {
            $balance = Balance::where('description', "Deposit#" . $request->reference)->first();
            if ($balance) {
                $balance->update(['status' => 3]);
            }
        }

        return true;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SmsStatus;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $smsStatuses = SmsStatus::all();
        return view('welcome', compact('smsStatuses'));
    }
}

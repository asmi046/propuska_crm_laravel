<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpressNotificationController extends Controller
{
    public function express_notification() {
        return view('express_notification');
    }
}

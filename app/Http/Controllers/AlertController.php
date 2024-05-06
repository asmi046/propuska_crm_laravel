<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function send_alert(Request $request) {
        $pass = $request->input('pass');

        if (empty($pass)) return [];
        sleep(2);
        return [$pass];
    }
}

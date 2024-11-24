<?php

namespace App\Http\Controllers;

use App\Models\ActivePass;
use Illuminate\Http\Request;
use App\Models\NoActivePasses;
use App\Services\MassAlertServices;

class AlertController extends Controller
{
    public function send_alert(Request $request, MassAlertServices $alert) {
        $pass = $request->input('pass');
        $message = $request->input('message');
        if (empty($pass)) return [];
        return $alert->do_alert($pass, $message);
    }
}

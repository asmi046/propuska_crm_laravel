<?php

namespace App\Http\Controllers;

use App\Services\MassAlertServices;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function send_alert(Request $request, MassAlertServices $alert)
    {
        $pass = $request->input('pass');
        $message = $request->input('message');
        $template = $request->input('template');
        if (empty($pass)) {
            return [];
        }

        return $alert->do_alert($pass, $message, $template);
    }
}

<?php

namespace App\Services;

use App\Models\ActivePass;
use App\Mail\Alert\AnnulMail;
use App\Models\NoActivePasses;

class MassAlertServices {

    protected function get_user_data(string $serias, string $number) {
        $active = ActivePass::where('series', $serias)->where('pass_number', $number)->first();
        $no_active = NoActivePasses::where('series', $serias)->where('pass_number', $number)->first();
        if ($no_active) return $no_active;
        if ($active) return  $active;
        return null;
    }


    public function do_alert(string $alert_pass) {

        $pass = str_replace(["-"," ","_"],"", $alert_pass);

        $serias = mb_substr($pass, 0, 2);
        $number = mb_substr($pass, 2);

        $an = $this->get_user_data($serias, $number);

        if (!$an)
        return [
            'pass' => $serias.$number,
            'truc_number' => "",
            'email' => "",
            'time' => "",
        ];

        Mail::to($an->email)->send(new AnnulMail($an->truc_number, $serias.$number));

        return [
            'pass' => $serias.$number,
            'truc_number' => $an->truc->truc_number,
            'email' => $an->truc->email,
            'time' => $an->type_pass,
        ];
    }

}
<?php

namespace App\Services;

use App\Models\ActivePass;
use App\Mail\Alert\AnnulMail;
use Illuminate\Mail\Mailable;
use App\Models\NoActivePasses;
use Illuminate\Support\Facades\Mail;

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
                'result' => 0,
            ];

        $adt_tosend = config('notification_adr.adr_to_send');
        // dump($an);
        if (config('app.env') === "production")
            $adt_tosend[] = $an->truc->email;

        Mail::to($adt_tosend)->send(new AnnulMail($an->truc_number, $serias.$number, $an->type_pass));

        return [
            'pass' => $serias.$number,
            'truc_number' => $an->truc->truc_number,
            'email' => $an->truc->email,
            'time' => $an->type_pass,
            'result' => 1,
        ];
    }

}

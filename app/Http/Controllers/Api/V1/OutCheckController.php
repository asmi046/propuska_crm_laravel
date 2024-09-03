<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\SiteQueryLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ChecNumberServices;

class OutCheckController extends Controller
{


    protected function getCaptcha($SecretKey) {
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".config('re_cap.re_captcha_key')."&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }

    protected function bot_check($token, $truck_number) {
        $rc_result = $this->getCaptcha($token);
        SiteQueryLog::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'truck_number' => $truck_number,
            "bot" => ($rc_result->success)?$rc_result->score:"0"
        ]);

        if ($rc_result->success == false || $rc_result->score <= 0.5)
            abort(403, 'Пшли вон!');
    }

    // public function get_all_number_variant($number, &$all_var) {
    //     $i=0;
    //     do {
    //         if ((ctype_digit($number[$i]) && ctype_alpha($number[$i+1]))||(ctype_alpha($number[$i]) && ctype_digit($number[$i+1])) ) {
    //             $ns = str_replace($number[$i].$number[$i+1],$number[$i]." ".$number[$i+1],$number);
    //             $all_var[] = $ns;
    //             $this->get_all_number_variant($ns, $all_var);
    //         }

    //         $i++;
    //     } while ($i<strlen($number)-2);

    //     return $all_var;
    // }

    public function get_number_info_for_site_zag(ChecNumberServices $detail_service, Request $request) {
        $number = $request->input('number');
        $token = $request->input('token');

        $this->bot_check($token, $number);

        if (!$number) abort(403, "Недостаточно данных");

        $all_var = [];
        $all_var[] = $number;
	    $rez_var = get_all_number_variant($number, $all_var);

        set_time_limit(60);

        $passes=[];
        foreach ($rez_var as $number_elem)
        {
            $info = $detail_service->chec_number($number_elem, "site");
            $passes = array_merge($passes, $info);
        }

        return $passes;
    }

    public function get_number_info_for_site(ChecNumberServices $detail_service, Request $request) {
        $number = $request->input('number');
        $token = $request->input('token');

        $this->bot_check($token, $number);

        if (!$number) abort(403, "Недостаточно данных");
        $info = $detail_service->chec_number($number, "site");
        return $info;
    }

    public function get_number_info_out(ChecNumberServices $detail_service, Request $request) {
        $number = $request->input('number');
        if (!$number) abort(403, "Недостаточно данных");
        $info = $detail_service->chec_number($number);
        return $info;
    }
}

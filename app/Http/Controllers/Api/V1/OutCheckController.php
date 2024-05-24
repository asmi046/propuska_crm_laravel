<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ChecNumberServices;

class OutCheckController extends Controller
{
    public function get_number_info_for_site(ChecNumberServices $detail_service, Request $request) {
        $number = $request->input('number');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChecNumberServices;
use App\Http\Requests\CheckTruckNumberRequest;

class NumberDetailController extends Controller
{
    public function check_number(CheckTruckNumberRequest $request, ChecNumberServices $detail_service, $number = "") {
        $true_number = $number;
        if (empty($true_number))
            $true_number = $request->input('truc_number');

        $info = $true_number?$detail_service->chec_number($true_number):null;

        // dd($info);

        return view('check_number', ['number' => $true_number, 'info' => $info]);
    }

    public function check_many_numbers(Request $request) {
        return view('check_many_numbers');
    }
}

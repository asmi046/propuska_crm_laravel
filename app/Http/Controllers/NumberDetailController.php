<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckTruckNumberRequest;

class NumberDetailController extends Controller
{
    public function check_number(CheckTruckNumberRequest $request, $number = "") {
        $true_number = $number;
        if (empty($true_number))
            $true_number = $request->input('truc_number');

        // dd($true_number);
        return view('check_number', ['number' => $true_number]);
    }

    public function check_many_numbers(Request $request) {
        return view('check_many_numbers');
    }
}

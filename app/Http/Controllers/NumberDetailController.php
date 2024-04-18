<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumberDetailController extends Controller
{
    public function check_number($number = "") {
        return view('check_number');
    }

    public function check_many_numbers(Request $request) {
        return view('check_many_numbers');
    }
}

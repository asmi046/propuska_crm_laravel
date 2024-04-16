<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumberDetailController extends Controller
{
    public function check_number($number = "") {

        return view('check_number');
    }
}

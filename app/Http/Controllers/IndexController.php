<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChecNumberServices;

class IndexController extends Controller
{
    public function index() {
        return view('dashboard');
    }

    public function test($number, ChecNumberServices $cn_service) {
       $result = $cn_service->chec_number($number);
        dd($result);
    }

}

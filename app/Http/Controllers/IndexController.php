<?php

namespace App\Http\Controllers;

use App\Models\CarNumber;
use Illuminate\Http\Request;
use App\Services\ChecNumberServices;

class IndexController extends Controller
{
    public function index() {
        $numbers = CarNumber::paginate(50);
        return view('dashboard', ['numbers' => $numbers]);
    }

    public function test($number, ChecNumberServices $cn_service) {
       $result = $cn_service->chec_number($number);
        dd($result);
    }

}

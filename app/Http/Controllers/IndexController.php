<?php

namespace App\Http\Controllers;

use App\Models\LastPass;
use App\Models\CarNumber;
use App\Filters\PassFilter;
use Illuminate\Http\Request;
use App\Services\ChecNumberServices;

class IndexController extends Controller
{
    public function index(PassFilter $request) {
        $numbers = CarNumber::select()->filter($request)->paginate(50);
        return view('dashboard', ['numbers' => $numbers]);
    }

    public function get_all_numbers(PassFilter $request) {
        $numbers = CarNumber::orderBy(
            LastPass::select('valid_from')
                ->whereColumn('last_passes.car_number_id', 'car_numbers.id')
            , "DESC")
            ->filter($request)
            ->get();
        return $numbers;
    }

    public function test($number, ChecNumberServices $cn_service) {
       $result = $cn_service->chec_number($number);
        dd($result);
    }

}

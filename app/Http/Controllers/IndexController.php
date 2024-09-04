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

    public function test_r() {
        // $number = iconv('-1252//IGNORE', 'UTF-8//IGNORE', "АХ1413-7");
        $number = "АХ1413-7";
        $symbols = ["А", "A", "В", "B", "Е", "E", "К", "K", "М", "M", "Н", "H", "О", "O", "Р", "P", "С", "C", "Т", "T", "У", "Y", "Х", "X"];
        $didgit = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];

        dump("НОШЕН!");
        dump($number[1]);
        dump($number[4]);
        dump(in_array($number[1], $symbols, true));
        dump(in_array($number[2], $didgit, true));
        dump(mb_str_split($number));

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\LastPass;
use App\Models\CarNumber;
use App\Filters\PassFilter;
use Illuminate\Http\Request;
use App\Services\ChecNumberServices;
use App\Services\TransleteratorServices;

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

        $pass = "БА1706377";
        $cn_service = new ChecNumberServices();

        //------------------------

        $pass_clear = trim(str_replace([" ", "-", " - "], "", $pass));
        $pass_info = $cn_service->chec_pass($pass_clear);
        $result = [
            'pass_number' => $pass_clear,
            'rus' => false,
            'truck_number' => "",
            'valid_from' => "",
            'valid_to' => "",
            'search_info' => "",
            'state' => "Нет информации по данному пропуску",
        ];


        if ($pass_info) {
            $result['truck_number'] = $pass_info[0]->truck_num;
            $result['rus'] = chec_rus($pass_info[0]->truck_num);
            $result['valid_from'] = date("d.m.Y", strtotime($pass_info[0]->valid_from));
            $result['valid_to'] = date("d.m.Y",  strtotime($pass_info[0]->valid_to));

            $srt = new TransleteratorServices();
            $all_variant = $srt->all_variant($pass_info[0]->truck_num);

            $base_number_items = CarNumber::whereIn('truc_number', $all_variant)->get();

            if (count($base_number_items) > 1)
            {
                $result['search_info'] = "Найдено ".count($base_number_items)." записей похожих на госномер ".$pass_info[0]->truck_num;
                $result['state'] = "Несколько вариантов для обновления";
            }
            elseif (count($base_number_items) == 1) {
                $s_elem = $base_number_items[0];
                $s_elem->truc_number = $pass_info[0]->truck_num;
                $s_elem->save();
                $fill_rez = $cn_service->fill_number_info($s_elem);
                $result['state'] = "Данные обновлены";
            } else {
                $new_element = CarNumber::create([
                    "truc_number" => $pass_info[0]->truck_num
                ]);

                $fill_rez = $cn_service->fill_number_info($new_element);
                $result['state'] = "Госномер добавлен в базу";
            }

            return $result;
        }



    }

}

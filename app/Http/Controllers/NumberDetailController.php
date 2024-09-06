<?php

namespace App\Http\Controllers;

use App\Models\CarNumber;
use Illuminate\Http\Request;
use App\Services\ChecNumberServices;
use App\Services\ActiveNumberServices;
use App\Services\TransleteratorServices;
use App\Http\Requests\CheckTruckNumberRequest;

class NumberDetailController extends Controller
{
    public function check_number(CheckTruckNumberRequest $request, ChecNumberServices $detail_service, $number = "") {
        $true_number = $number;
        if (empty($true_number))
            $true_number = $request->input('truc_number');

        $info = $true_number?$detail_service->chec_number($true_number):null;

        return view('check_number', ['number' => $true_number, 'info' => $info]);
    }

    public function update_number_info(ChecNumberServices $cn_service, ActiveNumberServices $an_services, $id) {
        $item = CarNumber::where('id', $id)->first();
        if(!$item) abort('404');

        // $result = $cn_service->chec_number($item->truc_number);
        // $an = $an_services->get_active_numbers($result, $item->id);

        // $item->active_numbers()->delete(['car_numbers_id' => $item->id]);

        // foreach ($an as $elem)
        //     $item->active_numbers()->create($elem);

        $cn_service->fill_number_info($item);

        return redirect()->back();

    }

    public function mass_check_pass_info(ChecNumberServices $cn_service, ActiveNumberServices $an_services, string $number) {

        set_time_limit(60);

        $result = $cn_service->chec_number($number, "site");

        $an = $an_services->get_active_numbers($result);
        $n_an = $an_services->get_no_active_numbers($result);

        $nData = date("Y-m-d");
        $state="Выдан другой датой";

        foreach ($result as $item) {
            if (!empty($item->record_updated_on) && ($item->series === "БА")){
                $dataUp = date("Y-m-d",strtotime($item->record_updated_on));
                if ($dataUp == $nData) {
                    $state = "Выдан сегодня";
                    break;
                }
            }
        }

        return [
            "state" => $state,
            "an" => $an,
            "n_an" => $n_an,
        ];
    }

    public function check_many_numbers(Request $request) {
        return view('check_many_numbers');
    }

    public function updet_by_numbers(Request $request) {
        return view('updet_by_numbers');
    }

    public function update_by_numbers_do(TransleteratorServices $srt, ChecNumberServices $cn_service, $pass) {

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

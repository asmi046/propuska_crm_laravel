<?php

namespace App\Services;

use App\Models\CarNumber;
use Illuminate\Support\Facades\Http;

class ChecNumberServices {

    protected function sort_passes(&$passes) {
        usort($passes, function ($v1, $v2) {
            return strtotime($v1->valid_to) > strtotime($v2->valid_to) ? -1 : 1;
        });
    }

    protected function get_color_class($state) {
        if ($state === "Начинается сегодня") return "start_today";
        if ($state === "Начинается завтра") return "start_tomorrow";
        if ($state === "Действует") return "deistvuet";
        if ($state === "Закончился") return "end";
        if ($state === "Заканчивается завтра") return "end_tomorrow";
        if ($state === "Заканчивается сегодня") return "end_today";
        if ($state === "Анулирован") return "anul";
    }

    protected function countDaysBetweenDates($d1, $d2)
    {
        $d1_ts = strtotime($d1);
        $d2_ts = strtotime($d2);

        $seconds = $d1_ts - $d2_ts;

        return floor($seconds / 86400);
    }

    protected function get_status($element) {
        $deycount = $this->countDaysBetweenDates($element->valid_to, date("Y-m-d H:i:s"));
        $deycount = (($deycount+1)<0)?0:($deycount+1);

        $status = "Действует";

        if (!empty($element->cancel_date)) $status = "Анулирован";
        if (!empty($element->cancel_date) && (strtotime($element->valid_to) == strtotime(date("Y-m-d")))) $status = "Анулирован сегодня";
        if (empty($deycount)) $status = "Закончился";
        if (strtotime($element->valid_to) == strtotime(date("Y-m-d"))) $status = "Заканчивается сегодня";
        if (strtotime($element->valid_to) == (strtotime(date("Y-m-d"))+86400)) $status = "Заканчивается завтра";
        if (strtotime($element->valid_from) == strtotime(date("Y-m-d"))) $status = "Начинается сегодня";
        if (strtotime($element->valid_from) == (strtotime(date("Y-m-d"))+86400)) $status = "Начинается завтра";

        return array(
            "sys_status" => $status,
            "deycount" => $deycount
        );
    }

    public function chec_number(string $truck_num = null, string $type = "old") {

        if (empty($truck_num)) return null;

        $response = Http::get(config('chec_service.service_url'), [
            'apikey' => config('chec_service.service_token'),
            'truck_num' => $truck_num,
        ]);

        $passes = $response->object()->passes;

        if (!empty($passes))
            $this->sort_passes($passes);

        foreach ($passes as $element)
        {
            $stauses = $this->get_status($element);
            $element->sys_status = $stauses['sys_status'];
            $element->deycount = $stauses['deycount'];
            $element->sys_color = $this->get_color_class($stauses['sys_status']);
        }


        return $passes;
    }


    public function fill_number_info(CarNumber $item) {

        if (!$item) return;

        $result = $this->chec_number($item->truc_number);
        $an_services = new ActiveNumberServices();

        $an = $an_services->get_active_numbers($result);
        $n_an = $an_services->get_no_active_numbers($result);

        // dd($an, $n_an);

        $item->active_numbers()->delete(['car_numbers_id' => $item->id]);
        $item->no_active_numbers()->delete(['car_numbers_id' => $item->id]);

        foreach ($an as $elem)
            $item->active_numbers()->create($elem);

        foreach ($n_an as $elem)
            $item->no_active_numbers()->create($elem);

        return [
            'active_number' => $an,
            'no_active_number' => $n_an,
        ];
    }
}

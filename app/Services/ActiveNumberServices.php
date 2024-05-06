<?php

namespace App\Services;

class ActiveNumberServices {

    protected $active_stauses = [
        "Начинается сегодня",
        "Начинается завтра",
        "Действует",
        "Заканчивается завтра",
        "Заканчивается сегодня",
    ];

    protected $no_active_stauses = [
        "Анулирован",
    ];

    public function get_active_numbers(array $numbers, int $car_number_id) {
        $active_numbers = [];
        foreach ($numbers as $item) {
            if (in_array($item->sys_status, $this->active_stauses))
               {
                    $item->car_number_id = $car_number_id;
                    $active_numbers[] = (array)$item;
               }
        }

        return $active_numbers;
    }
    public function get_no_active_numbers(array $numbers, int $car_number_id) {
        $rez = [];

        if (empty($numbers)) return $rez;

        foreach ($numbers as $item) {
            if (in_array($item->sys_status, $this->no_active_stauses))
                $rez[] = (array)$item;
        }

        if (empty($rez))
            $rez[] = (array)$numbers[0];

        return $rez;
    }

}

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

    public function get_active_numbers(array $numbers) {
        $active_numbers = [];
        foreach ($numbers as $item) {
            if (in_array($item->sys_status, $this->active_stauses))
               {
                    $active_numbers[] = (array)$item;
               }
        }

        return $active_numbers;
    }
    public function get_no_active_numbers(array $numbers) {
        $rez = [];

        if (empty($numbers)) return $rez;

        foreach ($numbers as $item) {
            if (in_array($item->sys_status, $this->no_active_stauses))
                $rez[] = (array)$item;
        }

        $last = (array)$numbers[0];
        if (empty($rez) && ($last['sys_status'] === 'Закончился'))
            $rez[] = $last;

        return $rez;
    }

}

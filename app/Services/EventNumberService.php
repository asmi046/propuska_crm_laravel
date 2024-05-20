<?php

namespace App\Services;

use App\Models\CheckLog;

class EventNumberService {

    public function start_checking(string $check_number) {
        CheckLog::create([
            'action' => "Начата проверка",
            'chec_id' => $check_number,
        ]);
    }

    public function end_checking(string $check_number, array $stat) {
        $main_data = [
            'action' => "Окончена проверка",
            'chec_id' => $check_number,
        ];

        $adding = array_merge($main_data, $stat);
        CheckLog::create($adding);
    }

}

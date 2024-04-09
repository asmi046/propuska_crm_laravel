<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChecNumberServices {
    public function chec_number(string $truck_num = null, string $type = "old") {

        if (empty($truck_num)) return null;

        $response = Http::get(config('chec_service.service_url'), [
            'apikey' => config('chec_service.service_token'),
            'truck_num' => $truck_num,
        ]);

        return $response->json();
    }

}

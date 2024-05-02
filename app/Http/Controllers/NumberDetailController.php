<?php

namespace App\Http\Controllers;

use App\Models\CarNumber;
use Illuminate\Http\Request;
use App\Services\ChecNumberServices;
use App\Services\ActiveNumberServices;
use App\Http\Requests\CheckTruckNumberRequest;

class NumberDetailController extends Controller
{
    public function check_number(CheckTruckNumberRequest $request, ChecNumberServices $detail_service, $number = "") {
        $true_number = $number;
        if (empty($true_number))
            $true_number = $request->input('truc_number');

        $info = $true_number?$detail_service->chec_number($true_number):null;

        // dd($info);

        return view('check_number', ['number' => $true_number, 'info' => $info]);
    }

    public function update_number_info(ChecNumberServices $cn_service, ActiveNumberServices $an_services, $id) {
        $item = CarNumber::where('id', $id)->first();
        if(!$item) abort('404');

        $result = $cn_service->chec_number($item->truc_number);
        $an = $an_services->get_active_numbers($result, $item->id);

        $item->active_numbers()->delete(['car_numbers_id' => $item->id]);

        foreach ($an as $elem)
            $item->active_numbers()->create($elem);

        return redirect()->back();

    }

    public function check_many_numbers(Request $request) {
        return view('check_many_numbers');
    }
}

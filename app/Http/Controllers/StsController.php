<?php

namespace App\Http\Controllers;

use App\Models\Sts;
use App\Models\CarNumber;
use Illuminate\Http\Request;

class StsController extends Controller
{

    public function index() {
        return view('sts_alert_list');
    }


    public function get_alert_list() {
        return Sts::all();
    }

    public function delete_elem(string $id) {
        $element = Sts::where("id", $id)->firstOrFail();
        return $element->delete();
    }

    public function add_sts(Request $request) {

        $trimed_number = trim( $request->input('truck_number') );
        $trimed_sts_data = trim( $request->input('sts_data') );

        $in_base = CarNumber::where("truc_number", $trimed_number)->first();
        if (!$in_base) abort(403, "Не найден в текущей базе");

        $in_fine_base = Sts::where("truc_number", $trimed_number)
            ->first();

        if ($in_fine_base) abort(403, "Уже есть в базе замены СТС");

        return Sts::create([
            'truc_number' => $trimed_number,
            'sts_data' => $trimed_sts_data,
            'email' => $in_base->email,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\CarNumber;
use Illuminate\Http\Request;

class FineController extends Controller
{

    public function index() {
        return view('fite_alert_list');
    }


    public function get_alert_list() {
        return Fine::all();
    }

    public function delete_elem(string $id) {
        $element = Fine::where("id", $id)->firstOrFail();
        return $element->delete();
    }

    public function add_to(Request $request) {

        $trimed_number = trim( $request->input('truck_number') );
        $trimed_fine_id = trim( $request->input('fine_number') );

        $in_base = CarNumber::where("truc_number", $trimed_number)->first();
        if (!$in_base) abort(403, "Не найден в текущей базе");

        $in_fine_base = Fine::where("truc_number", $trimed_number)
            ->where("fine_id", $trimed_fine_id)
            ->first();

        if ($in_fine_base) abort(403, "Уже есть в базе штрафов");

        return Fine::create([
            'truc_number' => $trimed_number,
            'fine_id' => $trimed_fine_id,
            'email' => $in_base->email,
        ]);
    }
}

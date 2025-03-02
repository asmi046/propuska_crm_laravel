<?php

namespace App\Http\Controllers;

use App\Models\CarNumber;
use Illuminate\Http\Request;
use App\Models\TechInspection;

class TechInspectionController extends Controller
{

    public function index() {
        return view('to_alert_list');
    }

    public function get_alert_list() {
        return TechInspection::all();
    }

    public function delete_elem(string $id) {
        $element = TechInspection::where("id", $id)->firstOrFail();
        return $element->delete();
    }

    public function add_to(string $number) {

        $trimed_number = trim($number);

        $in_base = CarNumber::where("truc_number", $trimed_number)->first();
        if (!$in_base) return [
                'truc_number' => $trimed_number,
                'email' => "",
                'state' => "Не найден в основной базе"
        ];

        $in_debtor_base = TechInspection::where("truc_number", $trimed_number)->first();
        if ($in_debtor_base) return [
            'truc_number' => $trimed_number,
            'email' => $in_base->email,
            'state' => "Уже есть номер в базе оповещения"
        ];
        TechInspection::create([
            'truc_number' => $trimed_number,
            'email' => $in_base->email,
        ]);

        return [
            'truc_number' => $trimed_number,
            'email' => $in_base->email,
            'state' => "Добавлен"
        ];
    }
}

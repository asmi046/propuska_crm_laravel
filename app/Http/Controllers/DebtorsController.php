<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use App\Models\CarNumber;
use Illuminate\Http\Request;
use App\Filters\DebtorsFilter;

class DebtorsController extends Controller
{
    public function debtors_dashboard(DebtorsFilter $request) {
        $all_debtors = Debtor::select()->filter($request)->paginate(50);

        return view('debtors_dashboard', ['debtors' => $all_debtors]);
    }

    public function debtors_add_do(Request $request) {
        $number = $request->input('number');
        if (!$number) abort(403, "Номер не передан");

        $in_base = CarNumber::where("truc_number", $number)->first();
        if (!$in_base) return [
                'truc_number' => $number,
                'email' => "",
                'state' => "Не найден в основной базе"
        ];

        $in_debtor_base = Debtor::where("truc_number", $number)->first();
        if ($in_debtor_base) return [
            'truc_number' => $number,
            'email' => $in_base->email,
            'state' => "Уже в базе должников"
        ];

        $element = Debtor::create([
                'truc_number' => $number,
                'email' => $in_base->email,
                'adding_data' => date("Y-m-d H:i:s"),
                'deys' => 1
        ]);

        return [
            'truc_number' => $number,
            'email' => $in_base->email,
            'state' => "Добавлен в базу"
        ];
    }

    public function debtors_dell(int $id) {
        $item = Debtor::where('id', $id)->first();
        if(!$item) abort('403', "Не найдена запись");

        $item->delete();

        return redirect()->back()->with('number_deleted', "Должник удален!");
    }

    public function debtors_add() {
        return view('debtors_add');
    }
}

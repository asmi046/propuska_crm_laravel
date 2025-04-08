<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use App\Models\CarNumber;
use Illuminate\Http\Request;
use App\Filters\DebtorsFilter;
use App\Http\Requests\Debtors;
use App\Services\ListServices;

class DebtorsController extends Controller
{
    public function debtors_dashboard(DebtorsFilter $request) {
        // $all_debtors = Debtor::select()->filter($request)->paginate(50);

        // return view('debtors_dashboard', ['debtors' => $all_debtors]);
        return view('debtors_dashboard');
    }

    public function debtors_dashboard_get(DebtorsFilter $request) {
        $all_debtors = Debtor::select()->filter($request)
        ->orderBy('adding_data', "DESC")
        ->get();
        return $all_debtors;
    }

    public function debtors_add_do(Request $request) {
        // $data = $request->validated();
        // $number = $data['number'];

        $number = $request->input('number');
        if (!$number) abort(403, "Номер не передан");

        $in_base = CarNumber::where("truc_number", $number)->first();
        if (!$in_base) return [
                'truc_number' => $number,
                'email' => "",
                'state' => "Не найден в основной базе"
        ];

        $in_debtor_base = Debtor::where("truc_number", $number)->get();
        if (count($in_debtor_base) > 1) return [
            'truc_number' => $number,
            'email' => $in_base->email,
            'state' => "Уже есть 2 номера в базе должников"
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

    public function debtors_dell_return(int $id) {
        $item = Debtor::where('id', $id)->first();
        if(!$item) abort('403', "Не найдена запись");
        $item->delete();

        return [
            'debtor_id' => $id
        ];
    }

    public function email_check() {
        $debtors = Debtor::all();

        $correct = 0;
        $incorrect = 0;

        foreach ($debtors as $item) {
            $email = CarNumber::where('email', $item->email)->where('truc_number', $item->truc_number)->first();
            if ($email) {
                $item->true_email = true;
                $correct++;
            } else {
                $item->true_email = false;
                $incorrect++;
            }

            $item->save();
        }

        return [
            'all' => count( $debtors ),
            'correct' => $correct,
            'incorrect' => $incorrect,
        ];
    }

    public function debtors_add() {
        return view('debtors_add');
    }

    public function debtors_chek() {
        return view('debtors_chek');
    }




    public function debtors_chek_do(Request $request, ListServices $ls) {
        $list = $request->input('list');

        $in_base = Debtor::whereIn('truc_number',$list)->get();
        $out_base = Debtor::whereNotIn('truc_number',$list)->get();
        $all_debtors = Debtor::all();

        $razn = $ls->list_compare( $all_debtors->toArray(), $list);

        return [
            'in_base' => $in_base,
            'out_base' => $out_base,
            'empty' => $razn,
        ];
    }
}

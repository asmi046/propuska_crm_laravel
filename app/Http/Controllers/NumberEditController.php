<?php

namespace App\Http\Controllers;

use App\Models\CarNumber;
use Illuminate\Http\Request;
use App\Models\DeletedNumber;
use App\Services\ChengeEmailServices;
use App\Http\Requests\NumberEditRequest;
use App\Http\Requests\EmailReplaceRequest;

class NumberEditController extends Controller
{
    public function index($id) {
        $numbers = CarNumber::where('id', $id)->first();

        if (!$numbers) abort('404');

        return view('edit_number_info', ['number_info' => $numbers]);
    }

    public function create() {
        return view('create_number_info');
    }


    public function save_number_info(NumberEditRequest $request, ChengeEmailServices $email_ch) {
        $data = $request->validated();

        $item = CarNumber::where('id', $request->input('item_id'))->first();
        if(!$item) abort('404');

        $old_email =$item->email;

        $item->update($data);

        $chenge_string = $email_ch->chenge_email_form_debtors($old_email, $data['email']);

        return redirect()->back()->with('number_info_save', "Данные сохранены. ".$chenge_string);
    }

    public function create_number_info(NumberEditRequest $request) {
        $data = $request->validated();

        $item = CarNumber::create($data);

        return redirect()->route('create')->with('number_info_save', "Номер добавлен");
    }

    public function add_many_numbers() {
        return view('add_many_numbers');
    }

    public function add_many_numbers_line(NumberEditRequest $request) {
        $data = $request->validated();

        $element = CarNumber::where('truc_number', $data['truc_number'])->first();

        if ($element) return ["state" => "Уже в базе"];

        $item = CarNumber::create($data);

        return ["state" => "Добавлен в базу"];
    }

    public function email_dop_add() {
        return view('email_dop_add');
    }

    public function email_dop_add_do(EmailReplaceRequest $request) {
        $data = $request->validated();

        $items = CarNumber::where('email', $data['email'])->get();

        foreach ($items as $item) {
            $item->update(
                [
                    'email_dop' => $data['new_email']
                ]
            );
        }

        return redirect()->back()->with('email_dop_add', "Дополнительный e-mail добавлен в: ".count($items)." записей");
    }

    public function email_chenge() {
        return view('email_chenge');
    }

    public function email_chenge_do(EmailReplaceRequest $request, ChengeEmailServices $email_ch) {
        $data = $request->validated();

        $items = CarNumber::where('email', $data['email'])->get();

        foreach ($items as $item) {
            $item->update(
                [
                    'email' => $data['new_email']
                ]
            );
        }

        $debtors_result = $email_ch->chenge_email_form_debtors($data['email'], $data['new_email']);

        $items_dop = CarNumber::where('email_dop', $data['email'])->get();

        foreach ($items_dop as $item) {
            $item->update(
                [
                    'email_dop' => $data['new_email']
                ]
            );
        }

        return redirect()->back()->with('email_chenget', "Найдено и заменено: ".count($items)." основных emeil и ".count($items_dop)." дополнительных email. ".$debtors_result);
    }

    public function delete_number($id) {

        $item = CarNumber::where('id', $id)->first();
        if(!$item) abort('404');

        $item->delete();

        return redirect()->back()->with('number_deleted', "Номер удален!");
    }

    public function delete_by_email() {
        return view('delete_by_email');
    }

    public function delete_by_email_do(Request $request) {

        $email = $request->input('email');

        $all_deleted_number = CarNumber::where('email', $email)->orWhere('email_dop', $email)->get();
        CarNumber::where('email', $email)->orWhere('email_dop', $email)->delete();

        $for_add = [];
        $all_car_number_str = "";



        foreach ($all_deleted_number as $item) {

            $for_add[] = [
                'truc_number' => $item->truc_number,
                'email' => $item->email,
                'email_dop' => $item->email_dop,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $all_car_number_str .= $item->truc_number.", ";
        }

        DeletedNumber::insert($for_add);

        return [
            'email' => $email,
            'count_number' => count($all_deleted_number),
            'numbers' => $all_car_number_str
        ];

    }
}

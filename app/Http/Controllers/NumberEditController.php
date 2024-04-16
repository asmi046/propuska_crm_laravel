<?php

namespace App\Http\Controllers;

use App\Models\CarNumber;
use Illuminate\Http\Request;
use App\Http\Requests\NumberEditRequest;

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


    public function save_number_info(NumberEditRequest $request) {
        $data = $request->validated();

        $item = CarNumber::where('id', $request->input('item_id'))->first();
        if(!$item) abort('404');

        $item->update($data);

        return redirect()->back()->with('number_info_save', "Данные сохранены");
    }

    public function create_number_info(NumberEditRequest $request) {
        $data = $request->validated();

        $item = CarNumber::create($data);

        return redirect()->route('edit_number_info', $item->id)->with('number_info_save', "Номер добавлен");
    }

    public function add_many_numbers() {
        return view('add_many_numbers');
    }

    public function create_many_numbers() {
        return view('add_many_numbers');
    }
}

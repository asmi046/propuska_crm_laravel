<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\CarNumber;
use Illuminate\Http\Request;
use App\Models\PassCreateLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Alert\TmpPassCreatedMail;
use App\Mail\Alert\MainPassCreatedMail;

class PassCreateInfoController extends Controller
{
    public function create_new_pass(Request $request) {
        $log_item = PassCreateLog::create(
            [
                "ip" => $_SERVER['REMOTE_ADDR'],
                "truck_num" => $request->input('truck_num'),
                "created" => $request->input('created'),
                "valid_from" => $request->input('valid_from'),
                "valid_to" => $request->input('valid_to'),
                "type_pass" => $request->input('type_pass'),
                "pass_zone" => $request->input('pass_zone'),
                "series" => $request->input('series'),
                "pass_number" => $request->input('pass_number'),
            ]
        );

        $truc_in_base = CarNumber::where('truc_number', $log_item->truck_num)->first();

        if (!$truc_in_base) {
            $log_item->update([
                'sys_status' => "Нет клиента в базе"
            ]);
            abort(406, "Нет клиента в базе");
        }

        $adt_tosend = config('notification_adr.adr_to_send');
        if (config('app.env') === "production")
            $adt_tosend[] =  $truc_in_base->email;

        // if ($log_item->series === "ББ")
        //     Mail::to($adt_tosend)->send(new TmpPassCreatedMail($log_item->toArray()));
        // else
        //     Mail::to($adt_tosend)->send(new MainPassCreatedMail($log_item->toArray()));

        $log_item->update([
            'sys_status' => "Отправлено клиенту"
        ]);
    }

}

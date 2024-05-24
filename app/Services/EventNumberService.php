<?php

namespace App\Services;

use App\Models\CheckLog;
use App\Models\CheckEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\Alert\MainPassEnd30Mail;
use App\Mail\Alert\MainPassEnd60Mail;
use App\Mail\Alert\TmpPassEndNowMail;
use App\Mail\Alert\TmpPassCreatedMail;
use App\Mail\Alert\MainPassCreatedMail;

class EventNumberService {

    public function start_checking(string $check_number) {
        CheckLog::create([
            'action' => "Начата проверка",
            'chec_id' => $check_number,
        ]);
    }

    public function end_checking(string $check_number, array $stat) {
        $main_data = [
            'action' => "Окончена проверка",
            'chec_id' => $check_number,
        ];

        $adding = array_merge($main_data, $stat);
        CheckLog::create($adding);
    }

    protected function check_event(string $name, string $truc_number, string $pass_number, string $fix_date = "") {

        $fix_date = empty($fix_date)?date("Y-m-d"):$fix_date;

        $event = CheckEvent::where('event_name', $name)
                            ->where('event_date', $fix_date)
                            ->where('number', $truc_number)
                            ->where('pass_number', $pass_number)->first();
        if (!$event) {
            CheckEvent::create([
                'event_name' => $name,
                'event_date' => $fix_date,
                'number' => $truc_number,
                'pass_number' => $pass_number,
            ]);
            return true;
        }
        else
            return false;
    }

    protected function date_is_now(string $c_data) {
        $now = date("Y-m-d 00:00:00");
	    $chdate = date("Y-m-d 00:00:00", strtotime($c_data));
        return strtotime($chdate) == strtotime($now);
    }

    protected function dey_count_to_date(string $c_data, int $chec_dey_count) {
        $now = date("Y-m-d 00:00:00");
	    $chdate = date("Y-m-d 00:00:00", strtotime($c_data));
        $deycount = floor((strtotime($chdate) - strtotime($now) ) / (60 * 60 * 24));
        return $deycount == $chec_dey_count;
    }

    protected function check_tmp_pass_created($pass, string $evant_name = "Выпущен временный пропуск") {
        return ($pass['series'] === "ББ")
            && $this->date_is_now($pass['valid_from'])
            && ($this->check_event($evant_name, $pass['truck_num'], $pass['series'].$pass['pass_number']));
    }

    protected function check_main_pass_created($pass, string $evant_name = "Выпущен постоянный пропуск") {
        return ($pass['series'] === "БA")
            && $this->date_is_now($pass['valid_from'])
            && ($this->check_event($evant_name, $pass['truck_num'], $pass['series'].$pass['pass_number']));
    }

    protected function check_tmp_pass_end_now($pass, string $evant_name = "Выпущен временный пропуск заканчивается сегодня") {
        return ($pass['series'] === "ББ")
            && $this->date_is_now($pass['valid_to'])
            && ($this->check_event($evant_name, $pass['truck_num'], $pass['series'].$pass['pass_number']));
    }

    protected function check_main_pass_end_60($pass, string $evant_name = "До окончания пропуска осталось 60 дней") {
        return ($pass['series'] === "БА")
            && $this->dey_count_to_date($pass['valid_to'], 60)
            && ($this->check_event($evant_name, $pass['truck_num'], $pass['series'].$pass['pass_number']));
    }

    protected function check_main_pass_end_30($pass, string $evant_name = "До окончания пропуска осталось 30 дней") {
        return ($pass['series'] === "БА")
            && $this->dey_count_to_date($pass['valid_to'], 30)
            && ($this->check_event($evant_name, $pass['truck_num'], $pass['series'].$pass['pass_number']));
    }

    protected function check_main_pass_annul($pass, string $evant_name = "Аннулирован пропуск") {
        return (!empty($pass->anul_data))
            && ($this->check_event($evant_name, $pass['truck_num'], $pass['series'].$pass['pass_number'], date("Y-m-d", strtotime($pass->anul_data))));
    }

    public function check_pass_events($pass, $email) {

        $adt_tosend = config('notification_adr.adr_to_send');
        if (config('app.env') === "production")
            $adt_tosend[] = $email;

        if ($this->check_tmp_pass_created($pass))
        {
            dump("Событие 1");
            Mail::to($adt_tosend)->send(new TmpPassCreatedMail($pass));
        }

        if ($this->check_main_pass_created($pass)) {
            dump("Событие 2");
            Mail::to($adt_tosend)->send(new MainPassCreatedMail($pass));
        }

        if ($this->check_tmp_pass_end_now($pass)) {
            dump("Событие 3");
            Mail::to($adt_tosend)->send(new TmpPassEndNowMail($pass));
        }

        if ($this->check_main_pass_end_60($pass)) {
            dump("Событие 4");
            Mail::to($adt_tosend)->send(new MainPassEnd60Mail($pass));
        }

        if ($this->check_main_pass_end_30($pass)) {
            dump("Событие 5");
            Mail::to($adt_tosend)->send(new MainPassEnd30Mail($pass));
        }

        if ($this->check_main_pass_annul($pass)) {
            dump("Событие 6");
            Mail::to($adt_tosend)->send(new MainPassEnd60Mail($pass));
        }

    }

}

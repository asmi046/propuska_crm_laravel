<?php

namespace App\Console\Commands;

use App\Jobs\SendToAlert;
use App\Models\TechInspection;
use App\Mail\Alert\ToAlertMail;
use Illuminate\Console\Command;
use App\Services\ChecNumberServices;
use Illuminate\Support\Facades\Mail;
use App\Mail\DebtorAlert\Debet11Mail;
use App\Mail\DebtorAlert\Debet15Mail;
use App\Mail\DebtorAlert\Debet20Mail;
use App\Services\ActiveNumberServices;

class ToAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alerts:to';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Оповещение о техкарте';

    protected function dey_count_calc(string $d1, string $d2)
    {
        $d1_ts = strtotime($d1);
        $d2_ts = strtotime($d2);

        $seconds = $d1_ts - $d2_ts;

        return floor($seconds / 86400);
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $all_numbers = TechInspection::all();

        $this->info("Найдено ".count($all_numbers)." номеров для оповещения");
        $this->info("Начата проверка и оповещение:");


        $index = 1;
        $delay = 0;
        $sendet = 0;
        $excaption_count = 0;
        $excaption = [];




        foreach($all_numbers as $item) {
            $this->line("#".$index." Проверяем номер: ".$item->truc_number);

            try {

                $deycount = ($item->last_message == null)?-1:$this->dey_count_calc(date("Y-m-d H:i:s"), $item->last_message);

                if ($deycount == -1 || $deycount >= 10) {
                    // SendToAlert::dispatch($item->truc_number, $item->email)->delay(now()->addMinutes($delay));

                    $adt_tosend = [];
                    $adt_tosend = config('notification_adr.adr_to_send');
                    if (config('app.env') === "production"){
                        $adt_tosend[] = $item->email;
                    }

                    Mail::to($adt_tosend)
                        ->later(now()->addMinutes($delay), new ToAlertMail($item->truc_number));

                    $item->update(['last_message' => now()]);
                    $this->info("Сообщение отправлено ".$deycount);
                    $sendet++;
                    $delay++;
                } else {
                    $this->error("Последнее оповещение было ".$deycount." назад");
                }

            } catch (\Throwable $e) {
                $excaption_count++;
                $excaption[$item->truc_number] = $e->getMessage();
                $this->error($e->getMessage());
            }

            $index++;
        }

        $this->info("Проверка завершена!");
        $this->info("Отправлено уведомлений: ".$sendet);
        $this->line("Ошибок: ".$excaption_count);
        $this->line("Расшифровка ошибок: ");
        var_dump($excaption);

    }
}

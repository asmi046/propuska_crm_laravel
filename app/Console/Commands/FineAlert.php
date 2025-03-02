<?php

namespace App\Console\Commands;

use App\Jobs\SendToAlert;
use App\Models\Fine;
use App\Mail\Alert\FineAlertMail;
use Illuminate\Console\Command;
use App\Services\ChecNumberServices;
use Illuminate\Support\Facades\Mail;
use App\Mail\DebtorAlert\Debet11Mail;
use App\Mail\DebtorAlert\Debet15Mail;
use App\Mail\DebtorAlert\Debet20Mail;
use App\Services\ActiveNumberServices;

class FineAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alerts:fine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Оповещение о штрафах';

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

        $all_numbers = Fine::all();

        $fines = [];

        foreach ($all_numbers as $item) {
            $fines[$item->truc_number]['last_message'] = $item->last_message;
            $fines[$item->truc_number]['email'] = $item->email;
            $fines[$item->truc_number]['fines'][] = $item->fine_id;
        }

        $this->info("Найдено ".count($all_numbers)." штрафов");
        $this->info("Найдено ".count($fines)." номеров для оповещения");
        $this->info("Начата проверка и оповещение:");


        $index = 1;
        $delay = 0;
        $sendet = 0;
        $excaption_count = 0;
        $excaption = [];


        $adt_tosend = config('notification_adr.adr_to_send');

        foreach($fines as $key => $item_f) {
            $this->line("#".$index." Проверяем номер: ".$key);

            try {

                $deycount = ($item_f['last_message'] == null)?-1:$this->dey_count_calc(date("Y-m-d H:i:s"), $item_f['last_message']);

                if ($deycount == -1 || $deycount >= 10) {

                    if (config('app.env') === "production"){
                        $adt_tosend[] = $item_f['email'];
                    }

                    Mail::to($adt_tosend)
                        ->later(now()->addMinutes($delay), new FineAlertMail($key, $item_f['fines']));

                    Fine::where('truc_number', $key)->update(['last_message' => now()]);

                    $this->info("Сообщение отправлено ".$deycount);
                    $sendet++;
                    $delay++;
                } else {
                    $this->error("Последнее оповещение было ".$deycount." назад");
                }

            } catch (\Throwable $e) {
                $excaption_count++;
                $excaption[$key] = $e->getMessage();
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

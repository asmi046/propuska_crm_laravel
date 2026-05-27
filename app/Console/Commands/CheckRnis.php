<?php

namespace App\Console\Commands;

use App\Mail\Alert\Rnis30Mail;
use App\Mail\Alert\Rnis60Mail;
use App\Models\RnisSubscribe;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckRnis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rnis:check-rnis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка РНИС и оповещение';

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

        $all_rnis = RnisSubscribe::with('car_number')->get();

        $this->info('Найдено '.count($all_rnis).' подписок РНИС в базе');
        $this->info('Начата проверка подписок РНИС:');

        $index = 1;
        $excaption_count = 0;
        $excaption = [];

        foreach ($all_rnis as $item) {
            $this->line('#'.$index.' Проверяем номер: '.$item->truc_number);

            try {

                $deycount = $this->dey_count_calc($item->end_subscribe, date('Y-m-d H:i:s'));

                $deycount = (($deycount + 1) < 0) ? 1 : ($deycount + 1);

                $this->info($item->truc_number.' - До окончания подписки РНИС '.$deycount.' дней. ');

                $adt_tosend = config('notification_adr.adr_to_send');

                if (config('app.env') === 'production') {
                    if ($item->car_number) {
                        $adt_tosend[] = $item->car_number->email;
                    }
                }

                if ($deycount == 60) {
                    Mail::to($adt_tosend)->send(new Rnis60Mail($item->truc_number, $item->end_subscribe));
                    $this->error($item->truc_number.' - До окончания подписки РНИС 60 дней. Оповещение отправлено');
                }

                if ($deycount == 30) {
                    Mail::to($adt_tosend)->send(new Rnis30Mail($item->truc_number, $item->end_subscribe));
                    $this->error($item->truc_number.' - До окончания подписки РНИС 30 дней. Оповещение отправлено');
                }

            } catch (\Throwable $e) {
                $excaption_count++;
                $excaption[$item->truc_number] = $e->getMessage();
                $this->error($e->getMessage());
            }

            $index++;
        }

        $this->info('Проверка завершена!');
        $this->line('Ошибок: '.$excaption_count);
        $this->line('Расшифровка ошибок: ');
        var_dump($excaption);

    }
}

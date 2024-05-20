<?php

namespace App\Console\Commands;

use App\Models\Debtor;
use Illuminate\Console\Command;
use App\Services\ChecNumberServices;
use Illuminate\Support\Facades\Mail;
use App\Mail\DebtorAlert\Debet11Mail;
use App\Mail\DebtorAlert\Debet15Mail;
use App\Mail\DebtorAlert\Debet20Mail;
use App\Services\ActiveNumberServices;

class CheckDebtors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debtors:check-debtors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка должников и оповещение';

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


        $all_debtors = Debtor::all();

        $this->info("Найдено ".count($all_debtors)." должников в базе");
        $this->info("Начата проверка должников:");


        $index = 1;
        $excaption_count = 0;
        $excaption = [];

        foreach($all_debtors as $item) {
            $this->line("#".$index." Проверяем номер: ".$item->truc_number);

            try {

                $deycount = $this->dey_count_calc(date("Y-m-d H:i:s"), $item->adding_data);
	            $deycount = (($deycount+1)<0)?1:($deycount+1);

                $item->update(['deys' => $deycount]);

                $this->info($item->truc_number.' - Задолженность '.$deycount." дней. ");

                $adt_tosend = config('notification_adr.adr_to_send');

                if (config('app.env') === "production")
                    $adt_tosend[] = $item->email;

                if ($deycount == 11) {
                    Mail::to($adt_tosend)->send(new Debet11Mail($item->truc_number));
                    $this->error($item->truc_number.' - Задолженность 10+ дней. Оповещение отправлено');
                }

                if ($deycount == 15) {
                    Mail::to($adt_tosend)->send(new Debet15Mail($item->truc_number));
                    $this->error($item->truc_number.' - Задолженность 14+ дней. Оповещение отправлено');
                }

                if ($deycount == 20) {
                    $annul_data = strtotime('+3 days');
                    Mail::to($adt_tosend)->send(new Debet20Mail($item->truc_number, $annul_data));
                    $this->error($item->truc_number.' - Задолженность 20+ дней. Оповещение отправлено');
                }

            } catch (\Throwable $e) {
                $excaption_count++;
                $excaption[$item->truc_number] = $e->getMessage();
                $this->error($e->getMessage());
            }




            $index++;
        }

        $this->info("Проверка завершена!");
        $this->line("Ошибок: ".$excaption_count);
        $this->line("Расшифровка ошибок: ");
        var_dump($excaption);

    }
}

<?php

namespace App\Console\Commands;

use App\Models\CarNumber;
use Illuminate\Console\Command;
use App\Services\ChecNumberServices;
use App\Services\EventNumberService;
use App\Services\ActiveNumberServices;

class CheckNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'numbers:check-numbers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка номеров и фиксация событий';

    /**
     * Execute the console command.
     */
    public function handle(ChecNumberServices $cn_service, EventNumberService $en_service)
    {

        $this->info("Начата проверка:");

        $all_numbers = CarNumber::all();

        $index = 1;
        $excaption_count = 0;
        $excaption = [];

        $stat = [
            'razovie' => 0,
            'postoyannie' => 0,
            'out30' => 0,
            'anul' => 0
        ];

        $chec_id = "CH_".date('d_m_Y')."_".rand(10000, 90000);
        $en_service->start_checking($chec_id);

        foreach($all_numbers as $item) {
            $this->line("#".$index." Проверяем номер: ".$item->truc_number);

            if (config('app.env') === "local" && $index > 27000) break;

            try {

                $rez = $cn_service->fill_number_info($item);

                foreach ($rez['active_number'] as $elem) {
                    $this->info("Добавлен активный пропуск: ".$elem['series']." ".$elem['pass_number']." ".$elem['type_pass']." ".$elem['sys_status']);
                    $en_service->check_pass_events($elem, $item->email);
                }

                foreach ($rez['no_active_number'] as $elem) {
                    $this->error("Добавлен не активный пропуск: ".$elem['series']." ".$elem['pass_number']." ".$elem['type_pass']." ".$elem['sys_status']);
                    $en_service->check_pass_events($elem, $item->email);
                }

            } catch (\Throwable $e) {
                $excaption_count++;
                $excaption[$item->truc_number] = $e->getMessage();
                $this->error($e->getMessage());
            }

            $index++;
        }

        $en_service->end_checking($chec_id, $stat);

        $this->info("Проверка завершена!");
        $this->line("Ошибок: ".$excaption_count);
        $this->line("Расшифровка ошибок: ");

    }
}

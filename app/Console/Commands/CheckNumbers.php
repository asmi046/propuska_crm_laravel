<?php

namespace App\Console\Commands;

use App\Models\CarNumber;
use Illuminate\Console\Command;
use App\Services\ChecNumberServices;
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
    public function handle(ChecNumberServices $cn_service)
    {

        $this->info("Начата проверка:");

        $all_numbers = CarNumber::all();

        $index = 1;
        $excaption_count = 0;
        $excaption = [];

        foreach($all_numbers as $item) {
            $this->line("#".$index." Проверяем номер: ".$item->truc_number);

            try {

                $rez = $cn_service->fill_number_info($item);

                foreach ($rez['active_number'] as $elem) {
                    $this->info("Добавлен активный пропуск: ".$elem['series']." ".$elem['pass_number']." ".$elem['type_pass']." ".$elem['sys_status']);
                }

                foreach ($rez['no_active_number'] as $elem) {
                    $this->error("Добавлен не активный пропуск: ".$elem['series']." ".$elem['pass_number']." ".$elem['type_pass']." ".$elem['sys_status']);
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

    }
}

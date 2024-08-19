<?php

namespace App\Console\Commands;

use App\Models\CarNumber;
use App\Models\DeletedNumber;
use Illuminate\Console\Command;

class NumberRecovery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'number:recovery';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Восстановдение номеров после удаления';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask('Введите e-mail для удаления (по умалчанию полное восстановление)?');

        $search_string = "%";
        if ($email)
        {
            $this->info("Восстанавливаем номера по e-mail: ".$email);
            $search_string = $email;
        }
        else {
            $this->error('Восстанавливаем всю базу');
        }

        $deleted_numbers = DeletedNumber::where('email', "LIKE", $search_string)->get();

        foreach ($deleted_numbers as $item) {
            $in_base = CarNumber::where('truc_number', $item->truc_number)->first();


            if (!$in_base) {
                CarNumber::create([
                    'truc_number' => $item->truc_number,
                    'email' => $item->email,
                    'email_dop' => $item->email_dop,
                ]);

                $this->info("Восстановлен номер: ".$item->truc_number . " email:" . $item->email . " доп. e-mail: ".$item->email_dop);
            } else {
                $this->error($item->truc_number . " уже есть в базе");
            }

        }
    }
}

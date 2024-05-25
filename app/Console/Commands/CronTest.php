<?php

namespace App\Console\Commands;

use App\Models\CarNumber;
use Illuminate\Console\Command;
use App\Mail\CronTestMail;
use Illuminate\Support\Facades\Mail;

class CronTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtest:cron-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка работы Cron';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->info("Начата проверка!");

        $adt_tosend = config('notification_adr.adr_to_send');
        Mail::to($adt_tosend)->send(new CronTestMail());

        $this->info("Проверка завершена!");

    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\CarNumber;
use App\Mail\CronTestMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ChengeUserPass extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:new-pass {email : Электронная почта} {pass : Новый Пароль}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Новый пароль для пользователя';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $email = $this->argument('email');
        $pass = Hash::make($this->argument('pass'));


        User::where('email', $email)->update([
            'password' => $pass
        ]);

        $this->info("Пароль изменен!");

    }
}

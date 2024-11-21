<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("email_templates")->insert(
            [
                [
                    'name' => "Сообщение об аннуляции завтра",
                    'subj' => "Пропуск на автомобиль [truc_number] будет аннулирован завтра",
                    'slug' => "annul",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/annul.html')),
                ],
                [
                    'name' => "Сообщение об аннуляции",
                    'subj' => "Пропуск [truck_num] аннулирован",
                    'slug' => "main_pass_annul",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/main_pass_annul.html')),
                ],
                [
                    'name' => "Вышел постоянный пропуск",
                    'subj' => "Вышел постоянный пропуск для [truck_num] до [valid_to]",
                    'slug' => "main_pass_created",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/main_pass_created.html')),
                ],
                [
                    'name' => "До окончания пропуска осталось 30 дней",
                    'subj' => "До окончания пропуска на [truck_num] осталось 30 дней",
                    'slug' => "main_pass_end_30",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/main_pass_end_30.html')),
                ],
                [
                    'name' => "До окончания пропуска осталось 60 дней",
                    'subj' => "До окончания пропуска на [truck_num] осталось 60 дней",
                    'slug' => "main_pass_end_60",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/main_pass_end_60.html')),
                ],
                [
                    'name' => "Вышел разовый пропуск",
                    'subj' => "Вышел разовый пропуск для [truck_num] до [valid_to]",
                    'slug' => "tmp_pass_created",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/tmp_pass_created.html')),
                ],

                [
                    'name' => "Временный пропуск заканчивается сегодня",
                    'subj' => "Временный пропуск на машину [truck_num] заканчивается сегодня",
                    'slug' => "tmp_pass_end_now",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/tmp_pass_end_now.html')),
                ],

                [
                    'name' => "Нет оплаты за пропуск  более 10 дней",
                    'subj' => "Нет оплаты за пропуск [truck_num] более 10 дней",
                    'slug' => "debt10",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/debt10.html')),
                ],

                [
                    'name' => "Нет оплаты за пропуск более двух недель",
                    'subj' => "Нет оплаты за пропуск [truck_num] более двух недель",
                    'slug' => "debt15",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/debt15.html')),
                ],

                [
                    'name' => "Нет оплаты за пропуск. Отправляем на аннуляцию.",
                    'subj' => "Нет оплаты за пропуск [truck_num]. Отправляем на аннуляцию.",
                    'slug' => "debt20",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/debt20.html')),
                ],
            ]
        );
    }
}

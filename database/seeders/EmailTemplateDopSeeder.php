<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class EmailTemplateDopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("email_templates")->insert(
            [
                [
                    'name' => "Сообщение об техосмотре",
                    'subj' => "На автомобиль [truc_number] нужно оформить техкарту",
                    'slug' => "to_deb",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/to.html')),
                ],
                [
                    'name' => "Сообщение об штрафах",
                    'subj' => "Для автомобиля [truc_number] нужно оплатить  штрафы",
                    'slug' => "fine_deb",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/fine.html')),
                ]
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class EmailTemplateAnnulStandartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('email_templates')->insert(
            [
                [
                    'name' => 'Стандартный шаблон об аннуляции',
                    'subj' => 'Пропуск на а/м [truc_number] будет аннулирован сегодня',
                    'slug' => 'annul_standart',
                    'text' => file_get_contents(database_path('seeders/old_data/emails/annul_standart.html')),
                ],
            ]
        );
    }
}

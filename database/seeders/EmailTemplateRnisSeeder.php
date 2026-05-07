<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class EmailTemplateRnisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('email_templates')->insert(
            [
                [
                    'name' => 'Сообщение об истечении подписки РНИС 60 дней',
                    'subj' => 'До окончания виртуального РНИС на [truc_number] осталось 60 дней',
                    'slug' => 'rnis_60_days',
                    'text' => file_get_contents(database_path('seeders/old_data/emails/rnis_60_days.html')),
                ],
                [
                    'name' => 'Сообщение об истечении подписки РНИС 30 дней',
                    'subj' => 'До окончания виртуального РНИС на [truc_number] осталось 30 дней',
                    'slug' => 'rnis_30_days',
                    'text' => file_get_contents(database_path('seeders/old_data/emails/rnis_30_days.html')),
                ],
            ]
        );
    }
}

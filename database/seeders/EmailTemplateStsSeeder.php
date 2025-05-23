<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class EmailTemplateStsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("email_templates")->insert(
            [
                [
                    'name' => "Сообщение об замене СТС",
                    'subj' => "Для пропуска на а/м [truc_number] требуется новое СТС ",
                    'slug' => "sts_ch",
                    'text' => file_get_contents(database_path('seeders/old_data/emails/sts.html')),
                ],
            ]
        );
    }
}

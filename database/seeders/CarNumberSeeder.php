<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class CarNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        include 'old_data/service_number.php';

        foreach ($service_number as $item) {
            DB::table("car_numbers")->insert(
                [
                    'truc_number' => $item['number'],
                    'email' => $item['email'],
                    'email_dop' => $item['email_dop'],
                    'phone' => $item['phone'],
                ]
            );
        }
    }
}

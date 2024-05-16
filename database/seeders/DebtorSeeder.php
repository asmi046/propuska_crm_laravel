<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class DebtorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        include 'old_data/dolg.php';

        foreach ($dolg as $item) {
            if (empty($item['number'])) continue;
            DB::table("debtors")->insert(
                [
                    'truc_number' => $item['number'],
                    'email' => $item['email'],
                    'adding_data' => date("Y-m-d H:i:s", strtotime($item['adding_data'])),
                    'checing_data' => ($item['checing_data'] === "0000-00-00 00:00:00")?NULL:date("Y-m-d H:i:s", strtotime($item['checing_data'])),
                    'deys' => $item['deys']
                ]
            );
        }
    }
}

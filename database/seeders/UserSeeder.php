<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userID = DB::table("users")->insertGetId(
            [
                'name' => "Сидоров",
                'email' => "asmi046@gmail.com",
                'password' => Hash::make("123"),
                'email_verified_at' => date("Y-m-d H:i:s"),
            ]
        );

    }
}

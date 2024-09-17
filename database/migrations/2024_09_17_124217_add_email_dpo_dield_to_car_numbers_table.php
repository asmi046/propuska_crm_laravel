<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('car_numbers', function (Blueprint $table) {
            $table->string('email_dop2')->nullable()->comment('Дополнительный e-mail 2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_numbers', function (Blueprint $table) {
            //
        });
    }
};

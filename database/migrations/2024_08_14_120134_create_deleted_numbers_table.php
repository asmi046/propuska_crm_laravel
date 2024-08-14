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
        Schema::create('deleted_numbers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('truc_number', 15)->comment('Номер автомобиля');
            $table->string('email')->nullable()->comment('e-mail');
            $table->string('email_dop')->nullable()->comment('Дополнительный e-mail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deleted_numbers');
    }
};

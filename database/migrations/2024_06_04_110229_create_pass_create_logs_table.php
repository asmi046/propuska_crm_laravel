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
        Schema::create('pass_create_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ip', 50)->comment('ip');
            $table->string('truck_num', 15)->nullable()->comment('Номер автомобиля');
            $table->dateTime('created')->nullable()->comment('Дата выпуска пропуска');
            $table->dateTime('valid_from')->nullable()->comment('Дата начала проверка');
            $table->dateTime('valid_to')->nullable()->comment('Дата окончания проверка');
            $table->string('series', 10)->nullable()->comment('Серия пропуска');
            $table->string('pass_number', 20)->nullable()->comment('Номер пропуска');
            $table->string('pass_zone', 10)->nullable()->comment('Зона пропуска');
            $table->string('type_pass')->nullable()->comment('Время пропуска');
            $table->string('sys_status')->default("Зарегистрировано")->comment('Статус в системе');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pass_create_logs');
    }
};

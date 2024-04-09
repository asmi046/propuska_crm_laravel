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
        Schema::create('car_numbers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('truc_number', 15)->comment('Номер автомобиля');
            $table->string('email')->comment('e-mail');
            $table->string('email_dop')->nullable()->comment('Дополнительный e-mail');
            $table->string('phone')->nullable()->comment('Телефон');
            $table->string('time')->nullable()->comment('Телефон');
            $table->string('pass_time')->nullable()->comment('Время пропуска');
            $table->string('status')->nullable()->comment('Статус пропуска');
            $table->string('sys_status')->nullable()->comment('Системный статус пропуска');
            $table->date('chec_time')->nullable()->comment('Последняя проверка');
            $table->date('start_data')->nullable()->comment('Дата начала проверка');
            $table->date('end_data')->nullable()->comment('Дата окончания проверка');
            $table->date('anul_data')->nullable()->comment('Дата анулиции проверка');

            $table->string('seria', 10)->nullable()->comment('Серия пропуска');
            $table->string('pass_number', 20)->nullable()->comment('Серия пропуска');
            $table->string('pass_type', 10)->nullable()->comment('Тип пропуска');
            $table->integer('dey_count')->nullable()->comment('Осталось дней');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_numbers');
    }
};

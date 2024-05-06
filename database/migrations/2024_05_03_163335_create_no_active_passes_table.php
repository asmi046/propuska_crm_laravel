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
        Schema::create('no_active_passes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('car_number_id')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

            $table->string('type_pass')->nullable()->comment('Время пропуска');
            $table->string('status')->nullable()->comment('Статус пропуска');
            $table->string('sys_status')->nullable()->comment('Системный статус пропуска');
            $table->string('sys_color')->nullable()->comment('Системный цвет');
            $table->timestamp('chec_time')->nullable()->comment('Последняя проверка')->useCurrent();
            $table->dateTime('valid_from')->nullable()->comment('Дата начала проверка');
            $table->dateTime('valid_to')->nullable()->comment('Дата окончания проверка');
            $table->dateTime('anul_data')->nullable()->comment('Дата анулиции проверка');

            $table->string('series', 10)->nullable()->comment('Серия пропуска');
            $table->string('pass_number', 20)->nullable()->comment('Номер пропуска');
            $table->string('pass_zone', 10)->nullable()->comment('Зона пропуска');
            $table->integer('deycount')->nullable()->comment('Осталось дней');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('no_active_passes');
    }
};

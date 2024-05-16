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
        Schema::create('debtors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('truc_number', 15)->comment('Номер автомобиля');
            $table->string('email')->comment('e-mail');
            $table->string('name', 100)->nullable()->comment('Имя');
            $table->dateTime('adding_data')->nullable()->comment('Дата добавления');
            $table->dateTime('checing_data')->nullable()->comment('Дата изменения');
            $table->integer('deys')->default(0)->comment('Осталось дней');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debtors');
    }
};

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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('truc_number', 15)->comment('Номер автомобиля');
            $table->string('email')->comment('e-mail');
            $table->string('fine_id')->comment('Идентификатор штрафа');
            $table->date('last_message')->nullable()->comment('Дата последнего оповещения');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};

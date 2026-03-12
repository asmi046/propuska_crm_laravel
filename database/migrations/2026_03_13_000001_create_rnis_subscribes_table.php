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
        Schema::create('rnis_subscribes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('truc_number', 15)->unique()->comment('Номер автомобиля');
            $table->date('end_subscribe')->comment('Дата окончания подписки');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rnis_subscribes');
    }
};

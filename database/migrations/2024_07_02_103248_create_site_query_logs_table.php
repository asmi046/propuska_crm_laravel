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
        Schema::create('site_query_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ip', 40)->comment('ip откуда пришел запрос');
            $table->string('truck_number', 20)->comment('Госномер');
            $table->string('bot')->comment('Оценка капчи');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_query_logs');
    }
};

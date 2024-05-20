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
        Schema::create('check_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('event_name', 100)->comment('Событие');
            $table->date('event_date')->comment('Время фиксации');
            $table->string('number', 40)->comment('Госномер');
            $table->string('pass_number', 40)->comment('Номер пропуска');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_events');
    }
};

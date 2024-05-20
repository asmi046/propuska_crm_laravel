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
        Schema::create('check_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('action', 30)->comment('Действие');
            $table->timestamp('starttime')->useCurrent()->comment('Время фиксации');
            $table->string('chec_id', 20)->comment('id проверки');
            $table->integer('razovie')->default(0)->comment('Разовые пропуска');
            $table->integer('postoyannie')->default(0)->comment('Постоянные пропуска');
            $table->integer('out30')->default(0)->comment('Закончится через 30 дней');
            $table->integer('anul')->default(0)->comment('Аннулировано');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_logs');
    }
};

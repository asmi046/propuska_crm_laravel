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
        Schema::table('check_events', function (Blueprint $table) {
            $table->boolean('important')->comment('Важное сообщение')->nullable()->default(false);
            $table->date('pass_end_date')->nullable()->comment('Дата окончания / аннуляции');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('check_events_2', function (Blueprint $table) {
            $table->dropColumn('important');
            $table->dropColumn('pass_end_date');
        });
    }
};

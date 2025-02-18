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
            $table->string('state', 120)->comment('Состояние')->nullable()->default("Непрочитанное");
            $table->boolean('manual_sendet')->comment('Ручное оповещение')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('check_events', function (Blueprint $table) {
            $table->dropColumn('state');
            $table->dropColumn('manual_sendet');
        });
    }
};

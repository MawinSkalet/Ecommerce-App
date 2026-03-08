<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('horses', function (Blueprint $table) {
            $table->unsignedSmallInteger('stat_speed')->default(300)->after('photo_url');
            $table->unsignedSmallInteger('stat_stamina')->default(300)->after('stat_speed');
            $table->unsignedSmallInteger('stat_power')->default(300)->after('stat_stamina');
            $table->unsignedSmallInteger('stat_guts')->default(300)->after('stat_power');
            $table->unsignedSmallInteger('stat_wisdom')->default(300)->after('stat_guts');
        });
    }

    public function down(): void
    {
        Schema::table('horses', function (Blueprint $table) {
            $table->dropColumn(['stat_speed', 'stat_stamina', 'stat_power', 'stat_guts', 'stat_wisdom']);
        });
    }
};

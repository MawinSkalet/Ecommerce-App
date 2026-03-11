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
        \DB::table('horses')
            ->where('registered_name', 'Tokai Teio')
            ->update(['photo_url' => '/images/horses/tokaiteio.png']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

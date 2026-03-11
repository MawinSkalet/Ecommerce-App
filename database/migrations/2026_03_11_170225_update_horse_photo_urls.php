<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $mapping = [
            'Special Week' => '/images/horses/special_week.png',
            'Silence Suzuka' => '/images/horses/silence_suzuka.png',
            'Tokai Teio' => '/images/horses/tokai_teio.png',
            'Mejiro McQueen' => '/images/horses/mejiro_mcqueen.png',
            'Vodka' => '/images/horses/vodka.png',
            'Gold Ship' => '/images/horses/gold_ship.png',
            'Rice Shower' => '/images/horses/rice_shower.png',
            'Symboli Rudolf' => '/images/horses/symbolirudolf.png',
            'Oguri Cap' => '/images/horses/oguricap.png',
            'Maruzensky' => '/images/horses/maruzensky.png',
            'Haru Urara' => '/images/horses/haruurara.png',
            'Twin Turbo' => '/images/horses/twinturbo.png',
        ];

        foreach ($mapping as $name => $photoUrl) {
            DB::table('horses')
                ->where('registered_name', $name)
                ->update(['photo_url' => $photoUrl]);
        }
    }

    public function down(): void
    {
        // No rollback needed
    }
};

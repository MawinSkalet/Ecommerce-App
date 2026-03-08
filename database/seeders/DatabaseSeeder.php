<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Models\Horse;
use App\Models\Listing;
use App\Models\Stable;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => '080-0000-0000',
            'role' => 'admin',
        ]);

        // Create a test customer
        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'phone' => '090-1234-5678',
            'role' => 'customer',
        ]);

        // Create breeds
        $breeds = [
            ['breed_name' => 'Thoroughbred', 'origin_country' => 'United Kingdom'],
            ['breed_name' => 'Arabian', 'origin_country' => 'Arabian Peninsula'],
            ['breed_name' => 'Quarter Horse', 'origin_country' => 'United States'],
            ['breed_name' => 'Appaloosa', 'origin_country' => 'United States'],
            ['breed_name' => 'Hanoverian', 'origin_country' => 'Germany'],
            ['breed_name' => 'Friesian', 'origin_country' => 'Netherlands'],
        ];
        foreach ($breeds as $b) {
            Breed::create($b);
        }

        // Create stables
        $stables = [
            ['stable_name' => 'Tracen Academy', 'address' => '1-1 Fuchu-cho', 'province' => 'Tokyo'],
            ['stable_name' => 'Miho Training Center', 'address' => '2048 Miho', 'province' => 'Ibaraki'],
            ['stable_name' => 'Ritto Training Center', 'address' => '1028 Ritto', 'province' => 'Shiga'],
            ['stable_name' => 'Northern Farm', 'address' => '469 Hayakita', 'province' => 'Hokkaido'],
            ['stable_name' => 'Shadai Farm', 'address' => '275 Hayakita', 'province' => 'Hokkaido'],
        ];
        foreach ($stables as $s) {
            Stable::create($s);
        }

        // Create horses with listings
        $horses = [
            [
                'registered_name' => 'Special Week',
                'sex' => 'female',
                'birth_date' => '2020-05-02',
                'description' => 'A spirited thoroughbred with an incredible appetite and even more incredible speed. Known for dramatic come-from-behind victories and an unwavering determination to become the best in Japan.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/de/8f/e8/de8fe81b34497035c0c39e0201c17b82.jpg',
                'breed_id' => 1,
                'stable_id' => 1,
                'stat_speed' => 950, 'stat_stamina' => 850, 'stat_power' => 800, 'stat_guts' => 700, 'stat_wisdom' => 750,
                'price' => 2500000,
            ],
            [
                'registered_name' => 'Silence Suzuka',
                'sex' => 'female',
                'birth_date' => '2019-05-01',
                'description' => 'An elegant and swift runner who loves to lead from the front. Her breathtaking speed in the opening stretch leaves all competitors far behind. A true front-runner legend.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/6f/a5/2c/6fa52cdf9cbf300e02d5b0dc302e93e3.jpg',
                'breed_id' => 1,
                'stable_id' => 1,
                'stat_speed' => 1100, 'stat_stamina' => 600, 'stat_power' => 750, 'stat_guts' => 650, 'stat_wisdom' => 700,
                'price' => 3200000,
            ],
            [
                'registered_name' => 'Tokai Teio',
                'sex' => 'female',
                'birth_date' => '2018-04-20',
                'description' => 'The Emperor of the turf, admired for her regal bearing and unbreakable spirit. Has overcome multiple injuries to return triumphantly to the racecourse. A symbol of resilience.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/67/2a/7b/672a7bd88b2c4da54ed72217bb2f143f.jpg',
                'breed_id' => 1,
                'stable_id' => 2,
                'stat_speed' => 1000, 'stat_stamina' => 800, 'stat_power' => 850, 'stat_guts' => 900, 'stat_wisdom' => 800,
                'price' => 3800000,
            ],
            [
                'registered_name' => 'Mejiro McQueen',
                'sex' => 'female',
                'birth_date' => '2018-04-03',
                'description' => 'A noble and proud stayer from the prestigious Mejiro family. Excels in long-distance races with her refined stamina and graceful running form.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/e6/fa/6a/e6fa6ad02a2394c8ced6b46699b922ee.jpg',
                'breed_id' => 1,
                'stable_id' => 2,
                'stat_speed' => 800, 'stat_stamina' => 1050, 'stat_power' => 750, 'stat_guts' => 700, 'stat_wisdom' => 850,
                'price' => 2800000,
            ],
            [
                'registered_name' => 'Vodka',
                'sex' => 'female',
                'birth_date' => '2021-04-04',
                'description' => 'A powerful and tomboyish filly who proved that mares can compete with the best. Won the Japanese Derby in stunning fashion, breaking barriers and expectations.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/4d/5c/ee/4d5cee51c420d7fb544355fc7f15ba2a.jpg',
                'breed_id' => 1,
                'stable_id' => 3,
                'stat_speed' => 900, 'stat_stamina' => 700, 'stat_power' => 950, 'stat_guts' => 800, 'stat_wisdom' => 650,
                'price' => 2200000,
            ],
            [
                'registered_name' => 'Gold Ship',
                'sex' => 'female',
                'birth_date' => '2019-03-06',
                'description' => 'A wildly unpredictable runner with an eccentric personality. Sometimes brilliantly fast, sometimes hilariously stubborn. Never a dull race when she is running.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/28/47/bf/2847bfa49e6faf992bbce85f534c8422.jpg',
                'breed_id' => 1,
                'stable_id' => 4,
                'stat_speed' => 750, 'stat_stamina' => 900, 'stat_power' => 1000, 'stat_guts' => 850, 'stat_wisdom' => 400,
                'price' => 1900000,
            ],
            [
                'registered_name' => 'Rice Shower',
                'sex' => 'female',
                'birth_date' => '2019-03-05',
                'description' => 'A gentle soul with a powerful closing kick. Known as the assassin of champions for her ability to defeat heavy favorites in G1 races. Deceptively strong.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/c2/69/3b/c2693bab8b2c628c4034028bcb85be87.jpg',
                'breed_id' => 1,
                'stable_id' => 3,
                'stat_speed' => 800, 'stat_stamina' => 1100, 'stat_power' => 700, 'stat_guts' => 950, 'stat_wisdom' => 750,
                'price' => 2100000,
            ],
            [
                'registered_name' => 'Symboli Rudolf',
                'sex' => 'male',
                'birth_date' => '2017-05-13',
                'description' => 'The legendary Emperor — Japan\'s first Triple Crown winner. Radiates authority, wisdom, and overwhelming ability. A true once-in-a-generation champion.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/f4/86/2a/f4862a923113409aaf54e909cf2031cc.jpg',
                'breed_id' => 1,
                'stable_id' => 5,
                'stat_speed' => 1050, 'stat_stamina' => 950, 'stat_power' => 900, 'stat_guts' => 850, 'stat_wisdom' => 1100,
                'price' => 5000000,
            ],
            [
                'registered_name' => 'Oguri Cap',
                'sex' => 'male',
                'birth_date' => '2018-03-27',
                'description' => 'The people\'s champion who rose from local racing to conquer the central stage. Known for a miraculous final race that moved an entire nation to tears.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/ce/6e/4a/ce6e4af9eda68dc011c1394635621e4c.jpg',
                'breed_id' => 3,
                'stable_id' => 4,
                'stat_speed' => 1000, 'stat_stamina' => 900, 'stat_power' => 950, 'stat_guts' => 1050, 'stat_wisdom' => 800,
                'price' => 4200000,
            ],
            [
                'registered_name' => 'Maruzensky',
                'sex' => 'male',
                'birth_date' => '2017-05-19',
                'description' => 'A foreign-bred star with dazzling speed and style. Never lost a race he started, winning with margins that left crowds in awe. A truly extraordinary talent.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/25/9f/f0/259ff01e7186c7831cfd9b859ad747ee.jpg',
                'breed_id' => 1,
                'stable_id' => 5,
                'stat_speed' => 1150, 'stat_stamina' => 700, 'stat_power' => 800, 'stat_guts' => 600, 'stat_wisdom' => 850,
                'price' => 3500000,
            ],
            [
                'registered_name' => 'Haru Urara',
                'sex' => 'female',
                'birth_date' => '2021-02-27',
                'description' => 'The lovable underdog who never gave up despite a famously long losing streak. Her determination and cheerful spirit inspired millions of fans across Japan.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/4f/f5/b7/4ff5b71624ca8d5522f17cc6baf3819e.jpg',
                'breed_id' => 1,
                'stable_id' => 3,
                'stat_speed' => 350, 'stat_stamina' => 400, 'stat_power' => 300, 'stat_guts' => 1200, 'stat_wisdom' => 500,
                'price' => 800000,
            ],
            [
                'registered_name' => 'Twin Turbo',
                'sex' => 'female',
                'birth_date' => '2020-04-13',
                'description' => 'A daring front-runner who races with all-or-nothing spirit. When she gets into the lead, the sheer intensity is electrifying. A fan-favorite for her bravery.',
                'status' => 'available',
                'photo_url' => 'https://i.pinimg.com/736x/21/c2/ff/21c2ffc572d9d30274ef57e2564d4c14.jpg',
                'breed_id' => 1,
                'stable_id' => 2,
                'stat_speed' => 1050, 'stat_stamina' => 350, 'stat_power' => 700, 'stat_guts' => 1100, 'stat_wisdom' => 450,
                'price' => 1500000,
            ],
        ];

        foreach ($horses as $h) {
            $price = $h['price'];
            unset($h['price']);
            $horse = Horse::create($h);

            Listing::create([
                'horse_id' => $horse->id,
                'list_price' => $price,
                'status' => 'active',
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\ItemInfo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        ItemInfo::factory()->create([
            'item_name' => 'IWI Tavor X95',
            'item_icon' => '2ony6.png',
            'item_id' => '2ony6'
        ]);

        ItemInfo::factory()->create([
            'item_name' => 'FN FAL',
            'item_icon' => '5lnw0.png',
            'item_id' => '5lnw0'
        ]);

        ItemInfo::factory()->create([
            'item_name' => 'Cheytac M300',
            'item_icon' => '2ongl.png',
            'item_id' => '2ongl'
        ]);

        ItemInfo::factory()->create([
            'item_name' => 'Экзоброня JD ZIVCAS 2A',
            'item_icon' => 'g43rp',
            'item_id' => 'g43rp'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeatLevel;

class HeatLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HeatLevel::truncate();
        $data = [
            ['name' => 'Hot','image' => 'heat_levels/Hot.jpg','description' => 'Examples: ceyen pepper'],
            ['name' => 'Medium','image' => 'heat_levels/Medium.jpg','description' => 'Examples: jalapeño'],
            ['name' => 'Mild','image' => 'heat_levels/Mild.jpg','description' => 'Examples: pepperoncini peppers'],
            ['name' => 'No Heat','image' => 'heat_levels/Noheat.jpg','description' => 'Examples: bell peppers'],
        ];

        foreach ($data as $item) {
            HeatLevel::create(['name' => $item['name'],'image' => $item['image'],'description' => $item['description']]);
        }

    }
}

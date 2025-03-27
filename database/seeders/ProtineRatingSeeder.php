<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProtineRating;

class ProtineRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProtineRating::truncate();
        $data = [
            ['name' => 'Beef + bison','description' => 'Examples: steaks, ground beef, meat balls','image' => 'protine_ratings/Beef+bison.jpg'],
            ['name' => 'Poultry','description' => 'Examples: chicken, ground turkey','image' => 'protine_ratings/Fish.jpg'],
            ['name' => 'Pork','description' => 'Examples: bacon, pork chops, carnitas','image' => 'protine_ratings/Lamb.jpg'],
            ['name' => 'Lamb','description' => 'Examples: lamb chops, lamb gyros','image' => 'protine_ratings/Pork.jpg'],
            ['name' => 'Fish','description' => 'Examples: salmon, cod, halibut','image' => 'protine_ratings/Poultry.jpg'],
            ['name' => 'Shellfish','description' => 'Examples: shrimp, lobster, crab, scallops','image' => 'protine_ratings/Shellfish.jpg'],
        ];

        foreach ($data as $item) {
            ProtineRating::create(['name' => $item['name'],'image' => $item['image'],'description' => $item['description']]);
        }
    }
}

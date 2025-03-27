<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DietaryPreference;

class DietaryPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DietaryPreference::truncate();
        $data = [
            ['name' => 'Omnivore', 'image' => 'dietary_preference/Omnivore.jpg', 'description' => 'I eat all types of meat & fish.'],
            ['name' => 'Pescatarian', 'image' => 'dietary_preference/Pescatarian.jpg', 'description' => 'I don’t eat meat. Just fish.'],
            ['name' => 'Vegetarian', 'image' => 'dietary_preference/Vegetarian.jpg', 'description' => 'I don’t eat meat or seafood.'],
            ['name' => 'Vegan', 'image' => 'dietary_preference/Vegan.jpg', 'description' => 'I don’t eat meat, seafood, dairy, or eggs.'],
            ['name' => 'Other', 'image' => 'dietary_preference/other.png', 'description' => 'Not available in listing.'],
        ];
        foreach ($data as $item) {
            DietaryPreference::create(['name' => $item['name'], 'image' => $item['image'], 'description' => $item['description']]);
        }
    }
}

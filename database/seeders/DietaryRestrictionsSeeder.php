<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DietaryPreference;
use App\Models\DietaryRestriction;

class DietaryRestrictionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DietaryRestriction::truncate();
        $data = [
            [
                'name' => 'Dairy',
                'image' => 'uploads/allergies/Dairy.png',
            ],
            [
                'name' => 'Gluten',
                'image' => 'uploads/allergies/Gluten.png',
            ],
            [
                'name' => 'Soy',
                'image' => 'uploads/allergies/Soy.png',
            ],
            [
                'name' => 'Tree Nuts',
                'image' => 'uploads/allergies/Tree Nuts.png',
            ],
            [
                'name' => 'Peanuts',
                'image' => 'uploads/allergies/Peanut.png',
            ],
            [
                'name' => 'Egg',
                'image' => 'uploads/allergies/Egg.png',
            ],
            [
                'name' => 'Shellfish',
                'image' => 'uploads/allergies/Shellfish.png',
            ],
            [
                'name' => 'None',
                'image' => 'uploads/allergies/Other.png',
            ]
        ];
        foreach ($data as $item) {
            DietaryRestriction::create(['name' => $item['name'], 'image' => $item['image']]);
        }
    }
}

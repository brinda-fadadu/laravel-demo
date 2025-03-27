<?php

namespace Database\Seeders;

use App\Models\Allergy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllergiesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Allergy::truncate();
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
            ]
        ];  
        foreach ($data as $allergy) {
            Allergy::create($allergy);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

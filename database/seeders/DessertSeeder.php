<?php

namespace Database\Seeders;

use App\Models\Dessert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DessertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Dessert::truncate();
        $data = [
            [
                'name' => 'Cookies',
                'image' => 'uploads/desserts/Cookies.png',
            ],
            [
                'name' => 'Ice Cream',
                'image' => 'uploads/desserts/Ice cream.png',
            ],
            [
                'name' => 'Milk Shakes',
                'image' => 'uploads/desserts/Milkshake.png',
            ],
            [
                'name' => 'Pudding',
                'image' => 'uploads/desserts/Pudding.png',
            ]
        ];  
        foreach ($data as $allergy) {
            Dessert::create($allergy);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

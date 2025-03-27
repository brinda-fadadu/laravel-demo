<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            PermissionSeeder::class,
            CategoryPermissionSeeder::class,
            AllergiesDataSeeder::class,
            AssignNutritionSeeder::class,
            BreakfastSeeder::class,
            CategorySeeder::class,
            CuisineSeeder::class,
            DessertSeeder::class,
            DietaryPreferenceSeeder::class,
            DietaryRestrictionsSeeder::class,
            HeatLevelSeeder::class,
            IngredientSeeder::class,
            MailTempleteSeeder::class,
            ProtineRatingSeeder::class,
            UserPermissionSeeder::class
        ]);
       
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Recipe; // Assuming Recipe is the name of the model
use Illuminate\Support\Facades\Http;

class GetRecipesWithNullCalories extends Command
{
    // The name and signature of the console command.
    protected $signature = 'recipes:calories';

    // The console command description.
    protected $description = 'Get all recipes where calories is null with recipe_ingredients';

    // Execute the console command.
    public function handle()
    {
        // Retrieve all recipes where calories is null and include the related recipe_ingredients
        $recipes = Recipe::whereNull('calories')
                        ->with('recipeIngredients') // Assuming 'recipeIngredients' is the relationship method
                        ->get();

        // Check if there are any recipes found
        if ($recipes->isEmpty()) {
            $this->info('No recipes with null calories found.');
        } else {
            // Loop through the recipes and display the relevant information
            foreach ($recipes as $recipe) {
                // Initialize an array to store formatted ingredients for this recipe
                $formattedIngredients = [];

                foreach ($recipe->recipeIngredients as $ingredient) {
                    // Format each ingredient and add to the array
                    $formattedIngredients[] = $this->formatIngredient($ingredient->amount, $ingredient->unit, $ingredient->name);
                }
                    $nutrition = $this->getNutritionDetails($formattedIngredients);

                    if ($nutrition) {
                        $calories = $nutrition['calories'] ?? null;
                        $totalFat = $nutrition['totalNutrients']['FAT'] ?? null;
                        $totalCarb = $nutrition['totalNutrients']['CHOCDF'] ?? null;
                        $totalProtein = $nutrition['totalNutrients']['PROCNT'] ?? null;
                        $cholesterol = $nutrition['totalNutrients']['CHOLE'] ?? null;

                        $recipe->update([
                            'calories' => $calories,
                            'total_fat' => $totalFat,
                            'total_carb' => $totalCarb,
                            'total_protein' => $totalProtein,
                            'cholesterol' => $cholesterol,
                        ]);

                    } else {
                        $ids[] = $recipe->id;
                        // $this->info("Nutrition details not available for {$recipe->name}");
                    }
                }
                $this->info("Nutrition details not available for ".print_r($ids,true)."\n");
            }
    }

    protected function formatIngredient($quantity, $unit, $name)
    {
        // Adjust the unit to a shorter format (for example, "Fluid Ounce" to "fl oz")
        $unit = $this->convertUnitToShortForm($unit);

        // Return the formatted ingredient string
        return "{$quantity} {$unit} {$name}";
    }

    // Method to convert units to their short form
    protected function convertUnitToShortForm($unit)
    {
        // Convert common units to short form
        $unitConversions = [
            'Fluid Ounce' => 'fl oz',
            'Cup' => 'cup',
            'Cup (c)' => 'cup',
            'Teaspoon' => 'tsp',
            'Tablespoon' => 'tbsp',
            // Add more unit conversions as needed
        ];

        return $unitConversions[$unit] ?? $unit; // If no conversion found, return the original unit
    }

    protected function getNutritionDetails($ingredient)
    {
        $url = 'https://api.edamam.com/api/nutrition-details?app_id=187f82d3&app_key=007fbb81f39d4c8c5c1af4c3b44e1ea9';

        // Prepare the payload
        $payload = [
            'ingr' => $ingredient,
        ];

        // Send POST request to Edamam API
        $response = Http::post($url, $payload);

        // Check if the response is successful
        if ($response->successful()) {
            return $response->json();
        }

        // Return null if the API request failed
        return null;
    }
}

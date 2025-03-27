<?php
namespace App\Helpers;

use App\Models\Breakfast;
use App\Models\CustomerBreakfast;
use App\Models\CustomerDessert;
use App\Models\CustomerDietaryPreference;
use App\Models\CustomerDietaryRestriction;
use App\Models\CustomerHeatLevel;
use App\Models\Dessert;
use App\Models\DietaryPreference;
use App\Models\HeatLevel;
use App\Models\RecipeIngredient;
use App\Models\User;
use App\Services\CommonService;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grocery;
use Illuminate\Support\Str;
use Carbon\Carbon;
class Helper
{
    /**
     * uniqueProfileUrl
     *
     * @param  mixed $length_of_string
     * @return void
     */
    public static function uniqueProfileUrl($length_of_string)
    {
        $alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $mix = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $code1 = substr(str_shuffle($alpha), 0, $length_of_string);
        $code2 = substr(str_shuffle($mix), 0, $length_of_string);
        return $code1 . $code2;
    }
    /**
     * generateRandomPassword
     *
     * @param  mixed $length
     * @return void
     */
    public static function generateRandomPassword($length = 10)
    {
        $specialChars = '!@#$%^&*()_+[]{}|:<>?';
        $capitalChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $smallChars = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';

        $password = '';

        // Ensure at least one special char, one number, one capital, and one small char
        $password .= $specialChars[rand(0, strlen($specialChars) - 1)];
        $password .= $capitalChars[rand(0, strlen($capitalChars) - 1)];
        $password .= $smallChars[rand(0, strlen($smallChars) - 1)];
        $password .= $numbers[rand(0, strlen($numbers) - 1)];

        // The remaining characters are filled with a mix of the above character sets
        $allowedChars = $specialChars . $capitalChars . $smallChars . $numbers;
        for ($i = 4; $i < $length; $i++) {
            $password .= $allowedChars[rand(0, strlen($allowedChars) - 1)];
        }

        // Shuffle the characters to randomize the password
        $password = str_shuffle($password);

        return $password;
    }

    static function isMultidimensionalArray($array) {
        if (!is_array($array)) {
            return false;
        }

        foreach ($array as $element) {
            if (is_array($element)) {
                return true; // Found a nested array
            }
        }

        return false; // No nested arrays found
    }


    public static function filterByUserPreferences($query, $userId) {
        $user = User::find($userId);

        // Removes user dietary restrictions recipes
        $dRIds = $user->customerDietaryRestrictions()->pluck('dietary_restriction_id')->toArray();
        if(!empty($dRIds)) {
            $query->whereDoesntHave('recipeDietaryRestrictions', function($q) use($dRIds){
                $q->whereIn('dietary_restriction_id', $dRIds);
            });
        }

        // Add Customer HeatLevel fields
        $dietaryPreference = CustomerDietaryPreference::where('user_id', $userId)->value('dietary_preference_id');
        if (!empty($dietaryPreference)) {
            $dietPref = DietaryPreference::whereId($dietaryPreference)->value('name');
            if(!empty($dietPref)) {
                $query->where('dietary_preference', 'LIKE', '%' . $dietPref . '%');
            }
        }

        // Add Customer Cuisines fields
        $userCuisines = $user->customerCuisines()->pluck('cuisines.id')->toArray();
        if (!empty($userCuisines) && count($userCuisines) > 0) {
            $query->whereIn('cuisine_id', $userCuisines);
        }

        // Add Customer HeatLevel fields
        $customerHeatLevel = CustomerHeatLevel::where('user_id', $userId)->value('heat_level_id');
        if (!empty($customerHeatLevel)) {
            $heatLevel = HeatLevel::whereId($customerHeatLevel)->value('name');
            if(!empty($heatLevel)) {
                $query->where('heat_level', 'LIKE', '%' . $heatLevel . '%');
            }
        }

       
        return $query;
    }

    
    public static function createGrocery($recipeIds, $user, $weekStartDate, $WeekEndDate) {
        $self = new self;
        $recipeIngredients = RecipeIngredient::whereIn('recipe_id', $recipeIds)->get();

        $userDate = Carbon::parse($user->groceries_start_date)->startOfDay();
        \Log::info('$userDate'.$userDate);
        // $WeekEndDate = Carbon::parse($user->groceries_end_date)->endOfDay();

        foreach ($recipeIngredients as $ingredient) {
            $userId = $user->id;
            $existingGrocery = Grocery::where('user_id', $userId)
    ->whereRaw('LOWER(name) = ?', [strtolower($ingredient['name'])])
    ->whereBetween('week_start_date', [$weekStartDate->format('Y-m-d'), $WeekEndDate->format('Y-m-d')])->first();

            $amount = $ingredient['amount'];

            if ($existingGrocery) {
                try {
                    // Convert amount to common unit
                    $amount = $self->convertToCommonUnit($ingredient['amount'], $ingredient['unit']);
                } catch (\Exception $e) {
                    continue;
                }

                $existingAmount = $self->convertToCommonUnit($existingGrocery->amount, $existingGrocery->unit);
                $newAmount = $existingAmount + $amount;
                // Format the amount with two decimal places
                $existingGrocery->amount = (floor($newAmount) == $newAmount) ? (string)$newAmount : sprintf("%.2f", $newAmount);
                $existingGrocery->save();
            } else {
                Grocery::create([
                    'uuid' => (string) Str::uuid(),
                    'user_id' => $userId,
                    'name' => $ingredient['name'],
                    'unit' => $ingredient['unit'],
                    'week_start_date' => $userDate,
                    'amount' => $amount
                ]);
            }
        }
    }

    private function convertToCommonUnit($amount, $unit)
    {
        switch (strtolower($unit)) {
            case 'milliliter':
            case 'ml':
            case 'milliliter (ml)':
                return $amount ; // Convert milliliters to liters
            case 'liter':
            case 'l':
            case 'liter (l)':
                return $amount; // Liters are the base unit for liquids
            case 'gram':
            case 'g':
            case 'gram (g)':
                return $amount; // Convert grams to kilograms
            case 'kilogram':
            case 'kg':
            case 'kilogram (kg)':
                return $amount; // Kilograms are the base unit for solids
            case 'cup':
            case 'c':
            case 'cup (c)':
                return $amount;
            case 'gallon':
            case 'gal':
            case 'gallon (gal)':
                return $amount; // Convert gallons to tablespoons
            case 'fluid ounce':
            case 'fl oz':
            case 'fluid ounce (fl oz)':
                return $amount; // Convert fluid ounces to tablespoons
            case 'ounce':
            case 'oz':
            case 'ounce (oz)':
                return $amount; // Convert ounces (weight) to tablespoons
            case 'pint':
            case 'pt':
            case 'pint (pt)':
                return $amount; // Convert pints to tablespoons
            case 'pound':
            case 'lb':
            case 'pound (lb)':
                return $amount; // Convert pounds to tablespoons (approximation)
            case 'quart':
            case 'qt':
            case 'quart (qt)':
                return $amount; // Convert quarts to tablespoons
            case 'tablespoon':
            case 'tbsp':
            case 'tablespoons':
            case 'tablespoon (tbsp)':
                return $amount; // Tablespoons are the base unit for volume
            case 'teaspoon':
            case 'tsp':
            case 'teaspoon (tsp)':
                return $amount; // Convert teaspoons to tablespoons
            case 'number':
            case 'pieces':
            case 'sliced':
            case 'n':
            case 'number (n)':
                return $amount; // No conversion needed for "number"
            default:
                throw new \Exception('Unknown unit: ' . $unit);
        }
    }
}
?>

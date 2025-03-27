<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $appends = ['avg_rating'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    // public function getAvgRatingAttribute()
    // {
    //     $rating = $this->hasMany(RecipeComment::class)->avg('star');
    //     return round($rating);
    // }

    public function getAvgRatingAttribute()
    {
        $rating = $this->hasMany(RecipeRating::class)->avg('star');
        return round($rating,1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class, 'cuisine_id', 'id');
    }

    public function recipeImage()
    {
        return $this->hasMany(RecipeImage::class, 'recipe_id', 'id');
    }

    public function userRecipe()
    {
        return $this->hasOne(UserRecipe::class, 'recipe_id', 'id')->orderBy('created_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function image()
    {
        return $this->hasOne(RecipeImage::class, 'recipe_id', 'id');
    }

    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function recipeInstructions()
    {
        return $this->hasMany(RecipeInstruction::class);
    }

    public function nutritionFacts()
    {
        return $this->hasMany(NutritionFact::class);
    }

    public function recipeComments()
    {
        return $this->hasMany(RecipeComment::class)->orderBy('created_at', 'desc');
    }

    public function recipeRatings()
    {
        return $this->hasMany(RecipeRating::class);
    }

    public function recipeLike()
    {
        return $this->hasOne(RecipeLike::class, 'recipe_id');
    }

    public function recipeDietaryRestrictions()
    {
        return $this->belongsToMany(DietaryRestriction::class, 'recipe_dietary_restrictions', 'recipe_id', 'dietary_restriction_id');
    }
}

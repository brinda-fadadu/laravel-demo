<?php

namespace App\Models;

use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Allergy extends Model
{
    use HasFactory, SoftDeletes, FileUploadTrait;
    protected $guarded = ['id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    // Define an accessor for the 'name' attribute
    public function getImageAttribute($value)
    {
        if(!empty($value)) {
            return asset($value);
        } 
        return null;
    }

    // Save image
    public function setImageAttribute($value)
    {
        $this->saveFile($value, 'image', "allergies/" . date('Y/m'));
    }

    // users
    public function users()
    {
        return $this->belongsToMany(User::class, 'customer_food_allergies', 'user_id','allergy_id');
    }
}

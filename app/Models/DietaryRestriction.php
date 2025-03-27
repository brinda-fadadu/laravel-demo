<?php

namespace App\Models;

use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;
use Illuminate\Database\Eloquent\Builder;

class DietaryRestriction extends Model
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

    protected static function booted()
    {
        static::addGlobalScope('roleAndStatusFilter', function (Builder $query) {
            $role = auth()->user()->role->name ?? null;
            if (!in_array($role, ['Admin', 'Sub Admin'])) {
                $query->where('status', 'active');
            }
        });
    }

    // Define an accessor for the 'name' attribute
    public function getImageAttribute($value)
    {
        if ($value) {
            if (!str_starts_with($value, 'uploads/')) {
                $value = 'uploads/' . ltrim($value, '/');
            }
            return url( $value);
        }

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

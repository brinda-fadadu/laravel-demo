<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class UserNutrition extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
    public function nutrition()
    {
        return $this->belongsTo(User::class, 'nutrition_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function booking()
    {
        return $this->hasMany(Booking::class, 'selected_user_id');
    }
}

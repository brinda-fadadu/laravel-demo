<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProtineRating extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['is_selected'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = \Str::uuid();
        });
    }

    public function getImageAttribute($value)
    {
        return url('/uploads/' . $value);
    }

    public function getIsSelectedAttribute()
    {
        if (request()->has('uuid')) {
            $user_id = User::where('uuid', request('uuid'))->value('id');
        } else {
            $user_id = auth()->id();
        }
        if ($this->hasOne(CustomerProtineRating::class)->where('user_id', $user_id)->exists()) {
            return $this->hasOne(CustomerProtineRating::class)->where('user_id', $user_id)->value('option');
        }
        return null;
    }

    public function customerProtineRating()
    {
        return $this->hasOne(CustomerProtineRating::class)->where('user_id', auth()->id());
    }
}

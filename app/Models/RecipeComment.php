<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class RecipeComment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded  = ['id'];
    protected $appends   = ['isLiked'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(RecipeComment::class,'parent_id');
    }

    public function likes(){
        return $this->hasMany(RecipeCommentLike::class,'comment_id');
    }

     // Accessor
     public function getIsLikedAttribute()
     {
        $userId = auth()->id();
        if(!empty($userId)) {
            // Assuming 'new_column' exists in your database table
            $isLiked = $this->likes()->where('user_id', $userId)->count();
            return ($isLiked) ? 1 : 0;
        }
        return 0;
    }
}

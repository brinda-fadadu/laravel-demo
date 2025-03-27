<?php

namespace App\Models;

use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;
use Illuminate\Database\Eloquent\Builder;
use App\Services\CommonService;
use Auth;
class Breakfast extends Model
{
    use HasFactory, SoftDeletes, FileUploadTrait;
    protected $guarded = ['id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
        static::addGlobalScope('roleScope', function (Builder $builder) {
            $user = Auth::user();

            if ($user) {
                if ($user->role_id !== CommonService::$ADMIN && $user->role_id !== CommonService::$SUBADMIN) {
                    $builder->where('status', 'active');
                }
            }
        });
    }
    // Define an accessor for the 'image' attribute
    public function getImageAttribute($value)
    {
        if (!empty($value) && \Storage::disk('upload')->exists($value)) {
            return $this->getFileUrl($value);
        } else {
            return config('app.url') . "/images/otherImage.png";
        }

    }

    // Save image
    public function setImageAttribute($value)
    {
        $this->saveFile($value, 'image', "breakfasts/" . date('Y/m'));
    }

    // users
    public function users()
    {
        return $this->belongsToMany(User::class, 'customer_breakfasts', 'user_id','breakfast_id');
    }
}

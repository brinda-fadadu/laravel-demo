<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Builder;
use App\Services\CommonService;
use Auth;

class HeatLevel extends Model
{
    use HasFactory, FileUploadTrait;

    protected $guarded = ['id'];

    protected $appends = ['is_selected'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = \Str::uuid();
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

    public function getImageAttribute($value)
    {
        if (!empty($value) && \Storage::disk('upload')->exists($value)) {
            return $this->getFileUrl($value);
        } else {
            return config('app.url') . "/images/otherImage.png";
        }
    }

    public function setImageAttribute($value)
    {
        $this->saveFile($value, 'image', "heat_levels/" . date('Y/m'));
    }

    public function getIsSelectedAttribute()
    {
        if (request()->has('uuid')) {
            $user_id = User::where('uuid', request('uuid'))->value('id');
        } else {
            $user_id = auth()->id();
        }

        if ($this->hasOne(CustomerHeatLevel::class)->where('user_id', $user_id)->exists()) {
            return true;
        }
        return false;
    }

    public function customerHeatlevel()
    {
        return $this->hasOne(CustomerHeatLevel::class)->where('user_id', auth()->id());
    }
}

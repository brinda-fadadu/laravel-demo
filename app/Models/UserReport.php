<?php
namespace App\Models;

use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class UserReport extends Model
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

    public function setReportUrlAttribute($value)
    {
        $this->saveFile($value, 'report_url', "reports/" . date('Y/m'));
    }

    public function getReportUrlAttribute($value)
    {
        if (!empty($value) && \Storage::disk('upload')->exists($value)) {
            return $this->getFileUrl($value);
        } else {
            return null;
        }
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

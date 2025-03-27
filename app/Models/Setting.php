<?php

namespace App\Models;

use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes, FileUploadTrait;

    protected $guarded = ['id'];

    /**
     * setProfileUrlAttribute
     *
     * @param  mixed $value
     * @return void
     */
    public function setValueAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            // File is present, proceed with saving
            $this->saveFile($value, 'value', "user/" . date('Y/m'));
        } elseif (is_string($value) && base64_decode($value, true) !== false) {
            // $value is a base64-encoded string, proceed with saving
            $this->saveFile($value, 'value', "user/" . date('Y/m'));
        } else {
            $this->attributes['value'] =  $value;
        }
    }

    // /**
    //  * getProfileUrlAttribute
    //  *
    //  * @param  mixed $value
    //  * @return void
    //  */
    // public function getValueAttribute($value)
    // {
    //     if (!empty($value) && \Storage::disk('upload')->exists($value)) {
    //         return $this->getFileUrl($value);
    //     }
    // }

    /**
     * getValueAttribute
     *
     * @param  mixed $value
     * @return void
     */
    public function getValueAttribute($value)
    {
        if (!empty($value) && \Storage::disk('upload')->exists($value)) {
            return $this->getFileUrl($value); // Assuming you have implemented this function to get the file URL
        } else {
            // Handle the case for text values here
            return $value;
        }
    }
}

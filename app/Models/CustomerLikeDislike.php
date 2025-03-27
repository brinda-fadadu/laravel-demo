<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLikeDislike extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'customer_likes_dislikes';

    // Define the fillable properties
    protected $fillable = ['name'];

    // You can also specify $timestamps if you want to disable automatic timestamps
    public $timestamps = true;
}

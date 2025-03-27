<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;
use Stripe\StripeClient;
class UserSubscription extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $appends = ['receipt_url'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id','id');
    }

    public function getReceiptUrlAttribute()
    {
        if (!$this->transaction_id) {
            return null; // Return null if there's no transaction ID
        }

        try {
            // Initialize Stripe Client
            $stripe = new StripeClient(config('services.stripe.secret_key'));

            // Retrieve the charge using the transaction ID
            $charge = $stripe->charges->retrieve($this->transaction_id);
            \Log::info($charge->receipt_url);
            \Log::info($this->id);

            // Return the receipt URL
            return $charge->receipt_url ?? null;
        } catch (\Exception $e) {
            // Log errors for debugging
            \Log::error('Error fetching Stripe receipt URL: ' . $e->getMessage());
            return null;
        }
    }
}

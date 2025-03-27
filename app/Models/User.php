<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
use Str;
use App\Models\Country;
use Carbon\Carbon;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, FileUploadTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['country_code_id', 'is_subscribed'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getCountryCodeIdAttribute()
    {
        if ($this->country_code) {
            return Country::where('id', $this->country_code)->value('code');
        } else {
            return null;
        }
    }

    public function getIsSubscribedAttribute()
    {
        if ($this->userSubscription()->exists()) {
            return true;
        }
        return false;
    }
    public function setProfileUrlAttribute($value)
    {
        // dd($value);
        $this->saveFile($value, 'profile_url', "user/" . date('Y/m'));
    }

    public function getProfileUrlAttribute($value)
    {
        if (!empty($value) && \Storage::disk('upload')->exists($value)) {
            return $this->getFileUrl($value);
        } else {
            return config('app.url') . "/images/user.webp";
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function nutrition()
    {
        return $this->hasOne(NutritionDetail::class, 'user_id', 'id');
    }

    public function bankDetails()
    {
        return $this->hasOne(NutritionBankDetail::class, 'user_id', 'id');
    }

    public function customerDetail()
    {
        return $this->hasOne(CustomerDetail::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    public function familyMember()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function report()
    {
        return $this->hasMany(UserReport::class);
    }

    public function userSubscription()
    {
        return $this->hasOne(UserSubscription::class)->where('status', 'active')->where('end_date', '>=', Carbon::now())->orderBy('id', 'desc');
    }

    public function recipe()
    {
        return $this->hasMany(Recipe::class);
    }

    public function userNutrition()
    {
        return $this->hasOne(UserNutrition::class, 'user_id', 'id')->orderBy('id', 'desc');
    }

    public function kitcheck()
    {
        return $this->hasOne(UserSubscription::class)->where('status', 'active')->where('end_date', '>=', Carbon::now())->where('payment_for', 'kit')->orderBy('id', 'desc');
    }

    public function customerAllergy()
    {
        return $this->hasOne(CustomerAllergy::class);
    }

    public function customerAllergies()
    {
        return $this->belongsToMany(Allergy::class, 'customer_food_allergies', 'user_id', 'allergy_id');
    }

    public function customerBreakfasts()
    {
        return $this->belongsToMany(Breakfast::class, 'customer_breakfasts', 'user_id', 'breakfast_id');
    }

    public function customerDesserts()
    {
        return $this->belongsToMany(Dessert::class, 'customer_desserts', 'user_id', 'dessert_id');
    }

    public function customerCuisines()
    {
        return $this->belongsToMany(Cuisine::class, 'customer_cuisines', 'user_id', 'cuisine_id');
    }

    public function customerDietaryRestrictions()
    {
        return $this->belongsToMany(DietaryRestriction::class, 'customer_diet_restrictions', 'user_id', 'dietary_restriction_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'selected_user_id');
    }
}

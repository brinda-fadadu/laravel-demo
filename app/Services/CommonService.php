<?php
namespace App\Services;

use App\Models\City;
use App\Models\Country;
use App\Models\Role;
use App\Models\State;

class CommonService
{
    public static $ADMIN;
    public static $SUBADMIN;
    public static $NUTRITIONIST;
    public static $CUSTOMER;

    public static function initialize()
    {
        self::$ADMIN = Role::where('name', 'Admin')->value('id');
        self::$SUBADMIN = Role::where('name', 'Sub Admin')->value('id');
        self::$NUTRITIONIST = Role::where('name', 'Nutritionist')->value('id');
        self::$CUSTOMER = Role::where('name', 'Customer')->value('id');
    }
        
    /**
     * getAllCountries
     *
     * @param  mixed $data
     * @return void
     */
    public static function getAllCountries($data)
    {
        if (!empty($data) && isset($data['country_id'])) {
            $country = Country::where('id', $data['country_id'])->first();

            if ($country) {
                $states = State::where('country_id', $country->id)->get();

                if ($states) {
                    return response()->json([
                        'status_code' => 200,
                        'data' => $states
                    ]);
                }

                return response()->json([
                    'status_code' => 400,
                    'message' => 'No states found for the given country.'
                ]);

            }
            
            return response()->json([
                'status_code' => 400,
                'message' => 'No country found'
            ]);

        } else if (!empty($data) && isset($data['state_id'])) {
            $state = State::where('id', $data['state_id'])->first();

            if ($state) {
                $cities = City::where('state_id', $state->id)->get();
                if (!$cities->isEmpty()) {
                    return response()->json([
                        'status_code' => 200,
                        'data' => $cities
                    ]);
                }
                return response()->json([
                    'status_code' => 400,
                    'message' => 'No cities found for the given state.'
                ]);
            }

            return response()->json([
                'status_code' => 400,
                'message' => 'No state found.'
            ]);
        }

        $countries = Country::get();

        return response()->json([
            'status_code' => 200,
            'data' => $countries
        ]);
    }
}

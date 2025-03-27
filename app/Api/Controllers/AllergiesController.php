<?php

namespace App\Api\Controllers;

use App\Api\Requests\Allergy\AllergyRequest;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Allergy;
use App\Models\User;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Str;

class AllergiesController extends Controller
{
    public function __construct()
    {
        CommonService::initialize();
    }
    
    /**
     * index
     *
     * @return void
     */
    public static function index()
    {
        try {
            $query  = Allergy::whereNull('user_id');
            if (request()->has('uuid')) {
                $user = User::where('uuid', request('uuid'))->first();
            } else {
                $user  = auth()->user();
            }
            $userAllergies = [];
            if(!empty($user)) {
                $userAllergies = $user->customerAllergies()->pluck('allergy_id')->toArray();
                
                // fetchs customer created customer allergies
                if ($user->role_id == CommonService::$CUSTOMER) {
                    $query->orWhere('user_id', $user->id);
                }
            }
            $allergies = $query->get();
            $data = $allergies->map(function($allergy) use($userAllergies){
                if(in_array($allergy->id, $userAllergies)) {
                    $allergy->setAttribute('is_selected', 1);
                } else {
                    $allergy->setAttribute('is_selected', 0);
                }
                return $allergy;
            });
            return $data;

        } catch (\Throwable $th) {
            return response()->json(['status_code' => 401, 'message' => $th->getMessage()], 401);
        }
    }

    
    /**
     * Create
     *
     * @param  mixed $request
     * @return void
     */
    public function create(AllergyRequest $request)
    {
        try {
            $records    = $request->data;
            $isMultiple = Helper::isMultidimensionalArray($records);
            if ($request->has('uuid')) {
                $user_id = User::where('uuid', $request->uuid)->value('id');
            } else {
                $user_id  = auth()->id();
            }
            if($isMultiple) {
                foreach($records as $data) {
                    $data['user_id']    = $user_id;
                    $data = Allergy::create($data);
                }
            } else {
                $data['user_id']    = $user_id;
            }
            return response()->json([
                'status_code'   => 200,
                'message'       => 'Customer allergy added successfully.',
                'data'          => []
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['status_code' => 401, 'message' => $th->getMessage()], 401);
        }
    }

    // /**
    //  * get By UUID
    //  *
    //  * @param  string $uuid
    //  * @return void
    //  */
    // public function getByUuid($uuid)
    // {
    //     try {
    //         $user = FacadesAuth::id();
    //         $data = Allergy::where('user_id', $user)->where('uuid', $uuid)->first();
    //         if(empty($data)) {
    //             return response()->json(['status_code' => 401, 'message' => 'Allergy data not found.'], 401);
    //         }
    //         return response()->json([
    //             'status_code'   => 200,
    //             'message'       => 'success',
    //             'data'          => $data
    //         ], 200);
    //     } catch (\Throwable $th) {
    //         return response()->json(['status_code' => 401, 'message' => $th->getMessage()], 401);
    //     }
    // }

    
    // /**
    //  * get By UUID
    //  *
    //  * @param  string $uuid
    //  * @return void
    //  */
    // public function update(AllergyRequest $request, $uuid)
    // {
    //     try {
    //         $data = $request->only('name', 'image');
    //         $user = FacadesAuth::id();
    //         $allergy = Allergy::where('user_id', $user)->where('uuid', $uuid)->first();
    //         if(empty($allergy)) {
    //             return response()->json(['status_code' => 401, 'message' => 'Allergy data not found.'], 401);
    //         }
    //         $allergy->update($data);
    //         return response()->json([
    //             'status_code'   => 200,
    //             'message'       => 'Customer allergy updated successfully.'
    //         ], 200);
    //     } catch (\Throwable $th) {
    //         return response()->json(['status_code' => 401, 'message' => $th->getMessage()], 401);
    //     }
    // }
        
    /**
     * delete
     *
     * @param  string $uuid
     * @return void
     */
    public function destroy($allergy_uuid)
    {
        try {
            if (request()->has('uuid')) {
                $user = User::where('uuid', request('uuid'))->value('id');
            } else {
                $user = FacadesAuth::id();   
            }
            $allergy = Allergy::where('user_id', $user)->where('uuid', $allergy_uuid)->first();
            if(empty($allergy)) {
                return response()->json(['status_code' => 401, 'message' => 'Allergy data not found.'], 401);
            }
            $allergy->delete();
            return response()->json([
                'status_code'   => 200,
                'message'       => 'Customer allergy deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['status_code' => 401, 'message' => $th->getMessage()], 401);
        }
    }

    /**
     * update Customer selection
     *
     * @param  mixed $request
     * @return void
     */
    public function updateCustomerSelection(Request $request)
    {
        try {
            $allergyIds = $request->allegyIds;
            if ($request->has('uuid')) {
                $user = User::where('uuid', $request->uuid)->first();
            } else {
                $user = FacadesAuth::user();
            }

            $user->customerAllergies()->sync($allergyIds);
            return response()->json([
                'status_code'   => 200,
                'message'       => 'Selection Updated successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['status_code' => 401, 'message' => $th->getMessage()], 401);
        }
    }

}

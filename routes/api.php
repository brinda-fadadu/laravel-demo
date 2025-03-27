<?php

use App\Api\Controllers\AllergiesController;
use App\Api\Controllers\AuthController;
use App\Api\Controllers\BreakfastController;
use App\Api\Controllers\CategoryController;
use App\Api\Controllers\ContactController;
use App\Api\Controllers\CuisineController;
use App\Api\Controllers\DashboardController;
use App\Api\Controllers\DessertController;
use App\Api\Controllers\DietaryRestrictionController;
use App\Api\Controllers\FamilyMemberController;
use App\Api\Controllers\GroceryController;
use App\Api\Controllers\MailTemplateController;
use App\Api\Controllers\NewsLetterController;
use App\Api\Controllers\NutritionistController;
use App\Api\Controllers\RecipeCommentController;
use App\Api\Controllers\RecipeController;
use App\Api\Controllers\RecipeLikeController;
use App\Api\Controllers\ReportController;
use App\Api\Controllers\RoleController;
use App\Api\Controllers\ScheduleRecipeController;
use App\Api\Controllers\SettingController;
use App\Api\Controllers\SubAdminController;
use App\Api\Controllers\SubscriptionController;
use App\Api\Controllers\UserController;
use App\Api\Controllers\PaymentController;
use App\Api\Controllers\BookingController;
use App\Api\Controllers\UserSubscriptionController;
use App\Api\Controllers\RecipeRatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Api\Controllers\DietaryPreferencesController;
use App\Api\Controllers\HeatLevelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::options('{any}', function (Request $request) {
    return response()->json([], 200);
})->where('any', '.*');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'authenticate']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);
Route::post('email-verification', [AuthController::class, 'emailVerification']);

// for a admin login

Route::post('admin/login', [AuthController::class, 'authenticate']);

Route::group(['prefix' => 'countries'], function () {
    Route::get('', [UserController::class, 'countries']);
});

Route::group(['prefix' => 'news-letter'], function () {
    Route::post('', [NewsLetterController::class, 'store']);
});

// global category and cuisine
Route::get('category', [CategoryController::class, 'index']);
Route::get('cuisine', [CuisineController::class, 'index']);

// global recipe
Route::group(['prefix' => 'recipes'], function () {
    Route::get('', [RecipeController::class, 'index']);
    Route::get('{uuid}', [RecipeController::class, 'show']);
    Route::post('', [RecipeController::class, 'store']);
    Route::post('filter', [RecipeController::class, 'filter']);
});

Route::get('recipe-filter-list', [UserController::class, 'getProfileData']);
// like and dislike foods

Route::get('like-dislikes', [UserController::class, 'foodChecklist']);

// uuid check
Route::get('uuid-check/{uuid}', [UserController::class, 'show']);

// add contact inquiry for a customer
Route::post('contact', [ContactController::class, 'store']);

// ingredients
Route::post('ingredient', [RecipeController::class, 'getIngredient']);

// wordpress subscription
Route::post('wordpress-subscription', [UserSubscriptionController::class, 'addwordpressSubscription']);
Route::post('renew-subscription', [UserSubscriptionController::class, 'renewwordpressSubscription']);

// wp-subscription
Route::post('wp-subscribe', [SubscriptionController::class, 'wpSubscribe']);

// get ingredients
Route::get('ingredients', [RecipeController::class, 'getAllIngredient']);

// wordpress subscription
Route::post('cancel-subscription', [UserController::class, 'cancelSubscription']);

// Route::group(['prefix' => 'comment'], function () {
//     Route::post('', [RecipeCommentController::class, 'store']);
//     Route::post('{uuid}', [RecipeCommentController::class, 'update']);
//     Route::delete('{uuid}', [RecipeCommentController::class, 'destroy']);
// });

// manage a settings
Route::group(['prefix' => 'setting'], function () {
    Route::get('', [SettingController::class, 'index']);
    Route::post('', [SettingController::class, 'store']);
});

// wordpress api for add members
Route::post('add-wordpress-members', [UserController::class, 'addWordpressMembers']);

Route::group(['prefix' => 'dietary-restrictions'], function () {
    Route::get('', [DietaryRestrictionController::class, 'getAll']);
});

Route::group(['middleware' => 'auth.jwt'], function () {

    Route::get('recipe-list', [RecipeController::class, 'recipeList']);

    // user's auth and profile
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::get('logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'profile'], function () {
        Route::get('', [AuthController::class, 'profile']);
        Route::post('', [AuthController::class, 'updateProfile']);
    });

    Route::group(['prefix' => 'customers'], function () {
        Route::get('', [UserController::class, 'index']);
        Route::get('{uuid}', [UserController::class, 'show']);
    });

    Route::group(['prefix' => 'admin'], function () {

        // manage dashboard .

        Route::get('dashboard', [DashboardController::class, 'index'])->middleware('can:DASHBOARD_VIEW');

        // manage a role and permission
        Route::group(['prefix' => 'role', 'middleware' => 'can:ROLE_VIEW'], function () {
            Route::get('', [RoleController::class, 'index']);
            Route::put('{id}', [RoleController::class, 'update'])->middleware('can:ROLE_EDIT');
            Route::get('{id}', [RoleController::class, 'show']);
        });

        Route::get('all-permissions', [RoleController::class, 'allPermissions']);

        // manage mail templates
        Route::group(['prefix' => 'mail-template', 'middleware' => 'can:MAIL_TEMPLATE_VIEW'], function () {
            Route::get('', [MailTemplateController::class, 'index']);
            Route::post('', [MailTemplateController::class, 'store'])->middleware('can:MAIL_TEMPLATE_ADD');
            Route::put('{uuid}', [MailTemplateController::class, 'update'])->middleware('can:MAIL_TEMPLATE_EDIT');
            Route::delete('{uuid}', [MailTemplateController::class, 'destroy'])->middleware('can:MAIL_TEMPLATE_DELETE');
            Route::get('{uuid}', [MailTemplateController::class, 'show']);
        });

        // manage contact us inquiries
        Route::group(['prefix' => 'contact', 'middleware' => 'can:CONTACT_LIST_VIEW'], function () {
            Route::get('', [ContactController::class, 'index']);
            Route::post('export', [ContactController::class, 'export']);
            Route::put('{id}', [ContactController::class, 'update'])->middleware('can:CONTACT_LIST_EDIT');
            Route::delete('{id}', [ContactController::class, 'destroy'])->middleware('can:CONTACT_LIST_DELETE');
            Route::get('{id}', [ContactController::class, 'show']);
        });

        // manage a category
        Route::group(['prefix' => 'category', 'middleware' => 'can:CATEGORY_VIEW'], function () {
            Route::get('', [CategoryController::class, 'index']);
            Route::post('', [CategoryController::class, 'store'])->middleware('can:CATEGORY_ADD');
            Route::post('export', [CategoryController::class, 'export']);
            Route::post('{uuid}', [CategoryController::class, 'update'])->middleware('can:CATEGORY_EDIT');
            Route::delete('{uuid}', [CategoryController::class, 'destroy'])->middleware('can:CATEGORY_DELETE');
            Route::get('{uuid}', [CategoryController::class, 'show']);
        });

        // manage a cuisine
        Route::group(['prefix' => 'cuisine', 'middleware' => 'can:CUISINE_VIEW'], function () {
            Route::get('', [CuisineController::class, 'index']);
            Route::post('', [CuisineController::class, 'store'])->middleware('can:CUISINE_ADD');
            Route::post('export', [CuisineController::class, 'export']);
            Route::post('{uuid}', [CuisineController::class, 'update'])->middleware('can:CUISINE_EDIT');
            Route::delete('{uuid}', [CuisineController::class, 'destroy'])->middleware('can:CUISINE_DELETE');
            Route::get('{uuid}', [CuisineController::class, 'show']);
            Route::post('update-selection', [CuisineController::class, 'updateCustomerSelection']);
        });

        // manage a dietary preferences
        Route::group(['prefix' => 'dietary-preferences'], function () {
            Route::get('', [DietaryPreferencesController::class, 'index']);
            Route::post('', [DietaryPreferencesController::class, 'store']);
            Route::post('{uuid}', [DietaryPreferencesController::class, 'update']);
            Route::delete('{uuid}', [DietaryPreferencesController::class, 'destroy']);
            Route::get('{uuid}', [DietaryPreferencesController::class, 'show']);
        });

        // manage a dietary restrictions
        Route::group(['prefix' => 'dietary-restrictions'], function () {
            Route::get('', [DietaryRestrictionController::class, 'indexPagination']);
            Route::post('', [DietaryRestrictionController::class, 'store']);
            Route::post('{uuid}', [DietaryRestrictionController::class, 'update']);
            Route::delete('{uuid}', [DietaryRestrictionController::class, 'delete']);
            Route::get('{uuid}', [DietaryRestrictionController::class, 'show']);
        });

        Route::group(['prefix' => 'breakfasts'], function () {
            Route::get('', [BreakfastController::class, 'indexPagination']);
            Route::post('', [BreakfastController::class, 'store']);
            Route::post('{uuid}', [BreakfastController::class, 'update']);
            Route::delete('{uuid}', [BreakfastController::class, 'delete']);
            Route::get('{uuid}', [BreakfastController::class, 'show']);
        });
        Route::group(['prefix' => 'desserts'], function () {
            Route::get('', [DessertController::class, 'indexPagination']);
            Route::post('', [DessertController::class, 'store']);
            Route::post('{uuid}', [DessertController::class, 'update']);
            Route::delete('{uuid}', [DessertController::class, 'delete']);
            Route::get('{uuid}', [DessertController::class, 'show']);
        });
        Route::group(['prefix' => 'heat-levels'], function () {
            Route::get('', [HeatLevelController::class, 'index']);
            Route::post('', [HeatLevelController::class, 'store']);
            Route::post('{uuid}', [HeatLevelController::class, 'update']);
            Route::delete('{uuid}', [HeatLevelController::class, 'destroy']);
            Route::get('{uuid}', [HeatLevelController::class, 'show']);
        });

        // manage a Nutritionist
        Route::group(['prefix' => 'nutritionist'], function () {
            Route::get('', [NutritionistController::class, 'index']);
            Route::post('', [NutritionistController::class, 'store']);
            Route::post('assign', [NutritionistController::class, 'assign']);
            Route::post('approval', [NutritionistController::class, 'approval']);
            Route::post('{uuid}', [NutritionistController::class, 'update']);
            Route::delete('{uuid}', [NutritionistController::class, 'destroy']);
            Route::get('{uuid}', [NutritionistController::class, 'show']);
        });

        // manage a SubAdmin
        Route::group(['prefix' => 'subAdmin'], function () {
            Route::get('', [SubAdminController::class, 'index']);
            Route::post('', [SubAdminController::class, 'store']);
            Route::post('{uuid}', [SubAdminController::class, 'update']);
            Route::delete('{uuid}', [SubAdminController::class, 'destroy']);
            Route::get('{uuid}', [SubAdminController::class, 'show']);
        });

        // manage a NewsLatter
        Route::group(['prefix' => 'newsLetter'], function () {
            Route::get('', [NewsLetterController::class, 'index']);
            Route::post('', [NewsLetterController::class, 'store']);
            Route::put('{id}', [NewsLetterController::class, 'update']);
            Route::delete('{id}', [NewsLetterController::class, 'destroy']);
            Route::get('{id}', [NewsLetterController::class, 'show']);
        });

        // manage a Customer
        Route::group(['prefix' => 'customer'], function () {
            Route::get('', [UserController::class, 'index']);
            Route::post('', [UserController::class, 'store']);
            Route::post('{uuid}', [UserController::class, 'update']);
            Route::delete('{uuid}', [UserController::class, 'destroy']);
            Route::get('{uuid}', [UserController::class, 'show']);
        });

        // manage a report
        Route::group(['prefix' => 'report'], function () {
            Route::get('', [ReportController::class, 'index']);
            Route::post('', [ReportController::class, 'store']);
            Route::delete('{uuid}', [ReportController::class, 'destroy']);
            Route::get('{uuid}', [ReportController::class, 'show']);
        });

        // manage a subscription
        Route::group(['prefix' => 'subscription'], function () {
            Route::get('', [SubscriptionController::class, 'index']);
            Route::post('', [SubscriptionController::class, 'store']);
            Route::post('{uuid}', [SubscriptionController::class, 'update']);
            Route::delete('{uuid}', [SubscriptionController::class, 'destroy']);
            Route::get('{uuid}', [SubscriptionController::class, 'show']);
        });


        // user export
        Route::group(['prefix' => 'user'], function () {
            Route::post('export', [UserController::class, 'export']);
            Route::post('filter', [UserController::class, 'filterUser']);
            Route::post('change-status', [UserController::class, 'changeStatus']);
        });

        Route::post('bulk-recipe', [RecipeController::class, 'import']);

        // manage assign Customers To Recipe
        Route::group(['prefix' => 'recipe'], function () {
            Route::get('', [RecipeController::class, 'getAssignCustomersToRecipe']);
            Route::post('{recipe_id}/customer', [RecipeController::class, 'assignCustomersToRecipe']);
            Route::delete('{uuid}', [RecipeController::class, 'destroyAssignCustomersToRecipe']);
            Route::get('{uuid}', [RecipeController::class, 'showAssignCustomersToRecipe']);
            Route::post('approve-reject', [RecipeController::class, 'recipeApproveReject']);
            Route::post('import', [RecipeController::class, 'import']);
        });

        // subscription customer list
        Route::get('subscription-list', [UserSubscriptionController::class, 'index']);
    });


    Route::group(['prefix' => 'customer'], function () {

        // Customer allergies API
        Route::group(['prefix' => 'allergies'], function () {
            Route::post('', [AllergiesController::class, 'create']);
            Route::delete('{uuid}', [AllergiesController::class, 'destroy']);
            Route::post('update-selection', [AllergiesController::class, 'updateCustomerSelection']);
            // Route::get('', [AllergiesController::class, 'index']);
            // Route::get('{uuid}', [AllergiesController::class, 'getByUuid']);
            // Route::post('{uuid}', [AllergiesController::class, 'update']);
        });

        // Customer allergies API
        Route::group(['prefix' => 'dietary-restrictions'], function () {
            Route::post('update-selection', [DietaryRestrictionController::class, 'updateCustomerSelection']);
            Route::post('', [DietaryRestrictionController::class, 'create']);
            Route::delete('{uuid}', [DietaryRestrictionController::class, 'destroy']);
            Route::get('', [DietaryRestrictionController::class, 'getAll']);
            // Route::get('{uuid}', [AllergiesController::class, 'getByUuid']);
            // Route::post('{uuid}', [AllergiesController::class, 'update']);
        });

        // Customer breakfast API
        Route::group(['prefix' => 'breakfasts'], function () {
            Route::post('', [BreakfastController::class, 'create']);
            Route::delete('{uuid}', [BreakfastController::class, 'destroy']);
            Route::post('update-selection', [BreakfastController::class, 'updateCustomerSelection']);
            // Route::get('', [BreakfastController::class, 'index']);
        });

        // Customer dessert API
        Route::group(['prefix' => 'desserts'], function () {
            Route::post('', [DessertController::class, 'create']);
            Route::delete('{uuid}', [DessertController::class, 'destroy']);
            Route::post('update-selection', [DessertController::class, 'updateCustomerSelection']);
            // Route::get('', [DessertController::class, 'index']);
        });

        // manage a cuisine
        Route::group(['prefix' => 'cuisine'], function () {
            Route::post('', [CuisineController::class, 'store']);
            Route::delete('{uuid}', [CuisineController::class, 'destroy']);
            Route::post('update-selection', [CuisineController::class, 'updateCustomerSelection']);
        });

        // manage a like dislike
        Route::group(['prefix' => 'like-dislike'], function () {
            Route::post('update-selection', [UserController::class, 'updateCustomerSelection']);
        });

        // add groceries for a customer
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('', [DashboardController::class, 'index']);
            Route::post('schedule', [DashboardController::class, 'scheduleDashboard']);
        });

        Route::group(['prefix' => 'grocery', 'middleware' => 'can:GROCERY_VIEW'], function () {
            Route::get('', [GroceryController::class, 'index']);
            Route::post('', [GroceryController::class, 'store'])->middleware('can:GROCERY_ADD');
            Route::post('export', [GroceryController::class, 'export']);
            Route::post('{uuid}', [GroceryController::class, 'update'])->middleware('can:GROCERY_EDIT');
            Route::delete('{uuid}', [GroceryController::class, 'destroy'])->middleware('can:GROCERY_DELETE');
            Route::get('{uuid}', [GroceryController::class, 'show']);
        });

        Route::group(['prefix' => 'family-member'], function () {
            Route::get('', [FamilyMemberController::class, 'index']);
            Route::post('', [FamilyMemberController::class, 'store']);
            Route::post('{uuid}', [FamilyMemberController::class, 'update']);
            Route::delete('{uuid}', [FamilyMemberController::class, 'destroy']);
            Route::get('{uuid}', [FamilyMemberController::class, 'show']);
        });

        // purchase subscription
        Route::post('purchase-subscription', [UserSubscriptionController::class, 'store']);

        Route::post('cancel-subscription', [UserSubscriptionController::class, 'cancelSubscription']);

        Route::post('reactivate-subscription', [UserSubscriptionController::class, 'reactivateSubscription']);

        // assigned nutrition check
        Route::get('get-nutrition', [NutritionistController::class, 'getNutrition']);

        // my reports
        Route::get('report', [ReportController::class, 'myReport']);

        // customer new portal page
        // Route::get('member-portal',[DashboardController::class,'memberPortal']);

        // like and dislike recipe
        Route::post('like-recipe', [RecipeLikeController::class, 'store']);
        Route::delete('remove-like/{uuid}', [RecipeLikeController::class, 'destroy']);
        Route::post('like-dislike-recipe', [RecipeLikeController::class, 'likeDislikeRecipe']);

        //  recipe comment
        Route::group(['prefix' => 'comment'], function () {
            Route::post('', [RecipeCommentController::class, 'store']);
            Route::post('like', [RecipeCommentController::class, 'likeRecipe']);
            Route::post('{uuid}', [RecipeCommentController::class, 'update']);
            Route::delete('{uuid}', [RecipeCommentController::class, 'destroy']);
        });

        //  recipe rating
        Route::group(['prefix' => 'rating'], function () {
            Route::post('', [RecipeRatingController::class, 'store']);
            Route::post('{uuid}', [RecipeRatingController::class, 'update']);
            Route::delete('{uuid}', [RecipeRatingController::class, 'destroy']);
        });

        // member count
        Route::get('count-members', [UserController::class, 'memberCount']);

        // invite member
        Route::post('invite-member', [UserController::class, 'inviteMember']);
        Route::post('member/update-type', [UserController::class, 'updateMemberRole']);
        Route::post('member/bulk-delete', [UserController::class, 'bulkDeleteMembers']);

        // all member
        Route::get('all-members', [UserController::class, 'allMembers']);

        // customer profile
        Route::post('profile', [UserController::class, 'customerProfile']);
        Route::post('listing-swap-recipe', [DashboardController::class, 'swapListingRecipe']);

        Route::post('update-swap-recipe', [DashboardController::class, 'swapRecipe']);

        Route::get('profile-data', [UserController::class, 'getProfileData']);

    });

    // manage recipe
    Route::group(['prefix' => 'recipe'], function () {
        Route::get('', [RecipeController::class, 'index']);
        Route::post('', [RecipeController::class, 'store']);
        Route::post('export', [RecipeController::class, 'export']);
        Route::post('filter', [RecipeController::class, 'filter']);
        Route::post('{uuid}', [RecipeController::class, 'update']);
        Route::delete('{uuid}', [RecipeController::class, 'destroy']);
        Route::get('{uuid}', [RecipeController::class, 'show']);
    });

    Route::group(['prefix' => 'nutritionist'], function () {
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::get('customer-list', [NutritionistController::class, 'customerList']);
        Route::post('export', [NutritionistController::class, 'export']);
        Route::get('customers', [NutritionistController::class, 'getCustomers']);
        Route::get('', [NutritionistController::class, 'getNutritionistForCustomer']);
        Route::post('add-customer', [NutritionistController::class, 'addUserAsCustomer']);
        Route::delete('{uuid}', [NutritionistController::class, 'destroyCustomer']);
        Route::get('{id}', [NutritionistController::class, 'NutritionShow']);
    });

    // manage a payment
    Route::group(['prefix' => 'payment'], function () {
        Route::get('', [PaymentController::class, 'index']);
        Route::post('export', [PaymentController::class, 'export']);
    });

    // schedule a recipe
    Route::group(['prefix' => 'schedule'], function () {
        Route::get('', [ScheduleRecipeController::class, 'index']);
        Route::post('', [ScheduleRecipeController::class, 'store']);
        Route::post('{uuid}', [ScheduleRecipeController::class, 'update']);
        Route::delete('{uuid}', [ScheduleRecipeController::class, 'destroy']);
    });

    Route::group(['prefix' => 'booking'], function () {
        Route::get('', [BookingController::class, 'index']);
        Route::post('', [BookingController::class, 'store']);
        Route::post('export', [BookingController::class, 'export']);
        Route::get('{uuid}', [BookingController::class, 'show']);
        Route::post('{uuid}', [BookingController::class, 'update']);
        Route::delete('{uuid}', [BookingController::class, 'destroy']);
    });

    // assign a customer when they buy package of a nutrition
    Route::get('assign-customer-request', [NutritionistController::class, 'assignCustomerRequest']);

    // customer kit check
    Route::get('customer-kit-check/{uuid}', [UserController::class, 'customerkitCheck']);
});

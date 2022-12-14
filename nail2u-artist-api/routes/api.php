<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\BookingController;
use Carbon\CarbonPeriod;

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

Route::prefix('auth')->group(function () {

    //Social Lite Routes
//    Route::get('login', function () {
//        return view('auth.register');
//    });
//    Route::get('login/{provider}', [AuthController::class, 'redirectToProvider']);
//    Route::get('login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);

    //Public Routes
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password/{token}/{email}', [AuthController::class, 'resetPassword']);

    Route::group(['middleware' => ['auth:api', 'role:artist']], function () {
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

//Services Routes
Route::group(['middleware' => ['auth:api', 'role:artist']], function () {

    Route::prefix('service')->group(function () {
        Route::get('all-raw', [ServiceController::class, 'allRaw']);
        Route::get('all', [ServiceController::class, 'all']);
        Route::post('add', [ServiceController::class, 'add']);
        Route::post('edit', [ServiceController::class, 'edit']);
        Route::post('remove-discount/{id}', [ServiceController::class, 'removeDiscount']);
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('user-data', [DashboardController::class, 'userData']);
        Route::get('user-jobs-details', [DashboardController::class, 'userJobsDetails']);
        Route::get('accept-job/{id}', [DashboardController::class, 'acceptJob']);
    });

    Route::prefix('user')->group(function () {
        Route::get('get-profile-details', [UserController::class, 'getProfileDetails']);
        Route::post('edit-profile', [UserController::class, 'editProfile']);
    });

    Route::prefix('portfolio')->group(function () {
        Route::get('get-details', [PortfolioController::class, 'getDetails']);
        Route::get('get-images', [PortfolioController::class, 'getImages']);
        Route::post('upload-image', [PortfolioController::class, 'uploadImage']);
        Route::post('delete-image', [PortfolioController::class, 'deleteImage']);
    });

    Route::prefix('payments')->group(function () {
        Route::get('get-total-earning', [PaymentController::class, 'getTotalEarning']);
    });

    Route::prefix('deals')->group(function () {
        Route::get('all', [DealController::class, 'all']);
    });

    Route::prefix('rating')->group(function () {
        Route::get('get-details', [RatingController::class, 'getDetails']);
    });

    Route::prefix('booking')->group(function () {
        Route::post('get-job-history', [BookingController::class, 'getJobHistory']);
    });

    Route::prefix('contact')->group(function () {
        Route::post('contact-us', [ContactUsController::class, 'contactUs']);
    });

    Route::prefix('settings')->group(function () {
        Route::post('update', [SettingController::class, 'update']);
    });

    Route::prefix('user')->group(function () {
        Route::get('get-profile-details', [UserController::class, 'getProfileDetails']);
        Route::post('edit-profile', [UserController::class, 'editProfile']);
    });
});

Route::any(
    '{any}',
    function () {
        return response()->json([
            'status_code' => 404,
            'message' => 'Page Not Found. Check method type Post/Get or URL',
        ], 404);
    }
)->where('any', '.*');

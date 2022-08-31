<?php

    use App\Http\Controllers\Api\{
        AuthController,
        UserController
    };
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

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

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group([
        'middleware' => 'api',
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
    });

    Route::prefix('/users')->middleware('auth:api')->group(function () {
        Route::get('/', [UserController::class, 'index']);
            Route::post('/filter-status', [UserController::class, 'filter_status']);
            Route::post('/filter-currency', [UserController::class, 'filter_currency']);
            Route::post('/filter-amount-range', [UserController::class, 'filter_amount_range']);
            Route::post('/filter-date-range', [UserController::class, 'filter_date_range']);
    });








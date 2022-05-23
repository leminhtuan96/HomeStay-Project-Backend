<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomHostController;

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


// Route::get('register',[AuthController::class,'getAll']);
Route::post('register', [AuthController::class, 'registerUser']);
Route::post('login', [AuthController::class, 'login']);

Route::prefix('admin')->middleware(['auth.jwt'])->group(function () {
    Route::post('password', [AuthController::class, 'changePassword']);
    Route::get('logout', [AuthController::class, 'logout']);
    //    Route::get('sendemail',[MailController::class,'sendEmail']);
    Route::get('host/{id}', [RoomHostController::class, 'roomHost']);
});
Route::prefix('user')->middleware(['auth.jwt'])->group(function () {
    Route::resource('room', RoomController::class);
    Route::post('booking', [UserController::class, 'booking']);
    Route::get('bookingdetail', [UserController::class, 'bookingDetail']);
    Route::get('cancelbooking/{id}', [UserController::class, 'cancelBooking']);
    Route::post('search', [RoomController::class, 'multiSearch']);
    Route::get('detail/{id}', [RoomHostController::class, 'getByid']);
    Route::get('detail/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'edit']);
});
Route::resource('room', RoomController::class);
Route::get('category', [RoomHostController::class, 'category']);
Route::get('city', [RoomHostController::class, 'city']);
Route::get('status', [RoomHostController::class, 'status']);
Route::get('city/{id}', [RoomController::class, 'getCity']);
Route::get('detailroom/{id}', [RoomController::class, 'getByIdRoom']);

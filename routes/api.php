<?php

use App\Http\Controllers\AdloginController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DistController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\NotificationController;
use App\Models\Rental_Car;
use Laravel\Passport\Passport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\RequestContext;
use App\Http\Controllers\DriverloginController;


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
Route::middleware('auth:sanctum','verified')->get('/user',function(Request $request){
    return $request->user();
});

Route::post('/register',[SigninController::class , 'register']);
Route::post('/login',[SigninController::class , 'login']);
 
Route::middleware('auth:sanctum')->group( function () {
      Route::post('/logout',[SigninController::class , 'logout']);
      Route::controller(RequestController::class)->group(function () {
        Route::post('/craete-request', 'store');
        Route::post('/group/{cab_ride}', 'groupRide');
        Route::post('/cancel/{cab_ride}', 'canceled');
    });
    Route::controller(ManagerController::class)->group(function(){
     Route::get('drivers/show','index');
     Route::get('drivers/details/{id}','show');
      Route::post('drivers/create','create');
      Route::put('drivers/edit/{driver_id}/{id}','update');
      Route::delete('drivers/delete/{driver_id}/{id}' ,'destroy');


    });
    Route::controller(RentalController::class)->group(function () {
        Route::post('/rental', 'store');
        Route::put('/update-car', 'update');
        Route::delete('/delete-car', 'destroy');
        Route::get('/show-cars', 'index');
        Route::get('show-details/{id}','show');

    

    });
    Route::controller(DriverController::class)->group(function () {
      Route::post('/show/{cab_ride}', 'distance');
      Route::post('/accept/{cab_ride}/{driver}', 'acceptRequest');
      Route::get('/finish/{cab_ride}/{driver}', 'finishRide');
      Route::post('/reject/{cab_ride}/{driver}', 'rejectRequest');
      Route::post('/driver-location/{driver_id}', 'driverLocaion');


});
      Route::post('/rate', [RatingController::class, 'rate']);
      Route::post('/rateshow', [RatingController::class, 'showRating']);

      Route::post('email/verification-notification', [EmailVerificationController::class , 'sendVerificationEmail']);
      Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class , 'verify'])->name('verification.verify');
      Route::post('refresh_token',[NotificationController::class,'refreshToken']);
      Route::post('send_notification/{id}',[NotificationController::class,'sendNotification']);
      Route::post('elctronic',[PayController::class,'pay']);

});
 







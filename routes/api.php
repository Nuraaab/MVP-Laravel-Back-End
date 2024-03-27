<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobPositionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>['auth:sanctum']],function(){
    
    
    Route::post('/auth/logout', [UserController::class, 'logout'])->name('logout');
  

    Route::post('/rental/add', [RentalController::class, 'addRental'])->name('addRental');
    Route::post('/rental/update/{id}', [RentalController::class, 'updateRental'])->name('updaterental');
    Route::delete('/rental/delete/{id}', [RentalController::class, 'deleteHouse'])->name('deletehouse');
    Route::get('/rental/recommendation/{id}', [RentalController::class, 'getRecomendation'])->name('recomendation');
    Route::get('/auth/getuser/{id}', [UserController::class, 'getUser'])->name('getuser');
    
    Route::post('/jobs/add', [JobPositionController::class, 'addJob'])->name('addiobs');
    Route::post('/jobs/update/{id}', [JobPositionController::class, 'updateJob'])->name('updatejob');
    Route::delete('/jobs/delete/{id}', [JobPositionController::class, 'deleteJob'])->name('deletejob');
});



Route::controller(UserController::class)->group(function () {
    Route::post('/auth/register', 'register')->name('register');
    Route::post('/auth/login', 'login')->name('login');
    
});
Route::post('rental/upload', [RentalController::class, 'uploadImage'])->name('image');
Route::get('/image/{fileName}', [RentalController::class, 'getImage'])->name('image');
Route::get('/rental',[RentalController::class, 'getRental'] )->name('rental');
Route::get('/jobs', [JobPositionController::class, 'getJobs'])->name('jobs');
Route::post('/auth/edit/{id}',[UserController::class, 'editProfile'])->name('profile');
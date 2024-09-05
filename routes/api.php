<?php

use App\Http\Controllers\LocationsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PassengernumberController;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/locations',[LocationsController::class,'index']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::get('/userme/{id}',[UserController::class,'userme']);

Route::put('/transactionsedit/{id}',[TransactionsController::class,'editTransaction']);
Route::put('/transactionsdelete/{id}',[TransactionsController::class,'deleteTransaction']);


Route::put('/confirmtransaction/{id}',[TransactionsController::class,'confirmTransaction']);
Route::put('/canceltransaction/{id}',[TransactionsController::class,'cancelTransaction']);

Route::put('/donetransaction/{id}',[TransactionsController::class,'doneTransaction']);

Route::put('/unavailableStatus/{id}',[UserController::class,'unavailableStatus']);
Route::put('/availableStatus/{id}',[UserController::class,'availableStatus']);

Route::get('/users/male-count', [UserController::class, 'getMaleCount']);
Route::get('/users/female-count', [UserController::class, 'getFemaleCount']);

Route::get('/users/d-count', [UserController::class, 'driveraccount']);
Route::get('/users/s-count', [UserController::class, 'studentaccount']);



Route::group(['middleware'=>['auth:sanctum']], function () {


    Route::get('/transactionsuser',[UserController::class,'userInfo']);
    Route::get('/transactionsdriver',[UserController::class,'driverInfo']);
    Route::post('/transactionadd',[TransactionsController::class,'addTransaction']);


    Route::get('/transactionsapprovedbooking/{id}',[TransactionsController::class,'getapprovedBooking']);
    Route::get('/transactionsdonebooking/{id}',[TransactionsController::class,'getdoneBooking']);
    Route::get('/transactionsbooking/{id}',[TransactionsController::class,'getBooking']);
    Route::get('/transactionscanceledbooking/{id}',[TransactionsController::class,'getcanceledBooking']);

    Route::get('/drivertransactionsbooking/{id}',[TransactionsController::class,'getdriverBooking']);//Pending
    Route::get('/drivertransactionapproved/{id}',[TransactionsController::class,'getapproveddriverBooking']); //Approved
    Route::get('/drivertransactiondone/{id}',[TransactionsController::class,'getdonedriverBooking']); //Done
    Route::get('/drivertransactioncancel/{id}',[TransactionsController::class,'getcanceldriverBooking']);





    Route::get('/locations',[LocationsController::class,'location']);


});

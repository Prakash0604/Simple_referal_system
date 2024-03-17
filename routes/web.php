<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('islogin')->group(function(){
    Route::get('/',[UserController::class, 'index'])->name('user.index');
    Route::post('/',[UserController::class, 'register'])->name('user.register');
    Route::get('/referal-code',[UserController::class, 'referal_code'])->name('referal_code');
    Route::get('/error',[UserController::class, 'error'])->name('error');
    Route::get('/email-verification/{token}',[UserController::class, 'emailverified'])->name('emailverified');
    Route::get('/login',[UserController::class, 'loadlogin']);
    Route::post('/login',[UserController::class, 'login']);
});



Route::middleware('islogout')->group(function(){
    Route::get('/dashboard',[UserController::class, 'dashboard']);
    Route::get('/logout',[UserController::class, 'logout']);
    Route::get('/delete',[UserController::class, 'delete']);
});
<?php

use App\Http\Controllers\InstagramController;
use App\Http\Controllers\JWTController;
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
    // return view('welcome');
// });

Route::get('/', function(){
    return ['Yus' => 'Chika'];
});
Route::get('instagram/compare', [InstagramController::class, 'compare']);
Route::get('jwt', [JWTController::class, 'index']);

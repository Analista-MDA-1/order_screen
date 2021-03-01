<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//se App\Http\Controllers\get_session_data;
use App\Http\Controllers\webhook;
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
    
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('categorie/{id?}',[categories::class, 'show'])->name('categorie_show');
Route::post('orden_create/',[webhook::class, 'store'])->name('create_store');
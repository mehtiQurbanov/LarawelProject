<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\carcontroller;


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

Route::get('/', function () {
    return view('welcome');
});


Route::get ('/mehdi','App\Http\Controllers\mehdicontroller@index');
Route::get ('/mehdi/{$ad}','App\Http\Controllers\mehdicontroller@person');
Route::get('/connect','App\Http\controllers\connectcontroller@connect');
Rout :: get('/connect','App\Http\controllers\Haqqindacontroller@index');



//  university tasks//
Route:: get ('/owners',[OwnerController::class, 'index'])->name('owners.index')->middleware(['replace']);
Route::get('/cars', [CarController::class, 'index'])->name('cars.index')->middleware(['replace']);

Route::middleware(['auth'])->group(function () {

    Route::post("owners/search", [OwnerController::class, 'search'])->name("owners.search");
    Route::post("cars/search", [CarController::class, 'search'])->name("cars.search");
    Route::get("cars/removeImage/{id}", [CarController::class, 'removeImage'])->name("cars.removeImage");

    Route::resource("owners", OwnerController::class)->except(['index'])->middleware('admin');
    Route::resource("cars", CarController::class)->except(['index'])->middleware('admin');
});

Route::get('/setLanguage/{lang}', [LanguageController::class, 'setLanguage'])->name("lang");
Route ::apiResource('name',UserController::class)->only(['show','store','update','destroy']);


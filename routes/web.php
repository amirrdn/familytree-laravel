<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamillyController;
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
    Route::get('/', [FamillyController::class, 'index']);
});

Route::group(['prefix' => 'family'], function(){
    Route::get('/', [FamillyController::class, 'index'])->name('family');
    Route::get('/create', [FamillyController::class, 'create'])->name('family-create');
    Route::post('/store', [FamillyController::class, 'store'])->name('families-store');
    Route::get('/edit/{id}', [FamillyController::class, 'edit'])->name('families-edit');
    Route::post('/update/{id}', [FamillyController::class, 'update'])->name('families-update');
});
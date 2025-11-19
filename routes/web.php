<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
//Route::get('/users/firmas', [UserController::class, 'peticionesFirmadas'])->middleware('auth');
//
//Route::controller(PetitionController::class)->group(function () {
//    Route::get('peticiones/index', 'index')->name('peticiones.index');
//    Route::get('mispeticiones', 'listMine')->name('peticiones.mine');
//    Route::get('peticionesfirmadas', 'peticionesFirmadas')->name('peticiones.peticionesfirmadas');
//    Route::get('peticiones/{id}', 'show')->name('peticiones.show');
//    Route::get('peticion/add', 'create')->name('peticiones.create');
//    Route::post('peticion', 'store')->name('peticiones.store');
//    Route::delete('peticiones/{id}', 'delete')->name('peticiones.delete');
//    Route::put('peticiones/{id}', 'update')->name('peticiones.update');
//    Route::post('peticiones/firmar/{id}', 'firmar')->name('peticiones.firmar');
//    Route::get('peticiones/edit/{id}', 'update')->name('peticiones.edit');
//});



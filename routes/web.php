<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [PageController::class, 'home'])->name('home');

Route::controller(PetitionController::class)->group(function () {
    Route::get('petitions/index', 'index')->name('petitions.index');
    Route::get('petitions/{id}', 'show')->name('petitions.show');
    Route::delete('petition/{id}', 'delete')->name('petitions.delete');
    Route::put('petition/{id}', 'update')->name('petitions.update');
    Route::get('petition/edit/{id}', 'edit')->name('petitions.edit');
});

Route::controller(PetitionController::class)->middleware('auth')->group(function () {
    Route::get('mypetitions', 'listMine')->name('petitions.mine');
    Route::get('signedPetitions', 'signedPetitions')->name('petitions.signedPetitions');
    Route::get('petition/add', 'create')->name('petitions.create');
    Route::post('petition', 'store')->name('petitions.store');
    Route::post('petition/sign/{id}', 'sign')->name('petitions.sign');
});



require __DIR__.'/auth.php';

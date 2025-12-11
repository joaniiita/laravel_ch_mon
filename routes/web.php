<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminPetitionController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->controller(AdminPetitionController::class)->group(function () {
    Route::get('admin', 'home')->name('admin.home');
    Route::get('admin/petitions/index', 'home')->name('adminpetitions.index');
    Route::get('admin/petition/{id}', 'show')->name('adminpetitions.show');
    Route::get('admin/petitions/add', 'create')->name('adminpetitions.create');
    Route::get('admin/petitions/edit/{id}', 'edit')->name('adminpetitions.edit');
    Route::post('admin/petitions', 'store')->name('adminpetitions.store');
    Route::delete('admin/petitions/{id}', 'delete')->name('adminpetitions.delete');
    Route::put('admin/petitions/{id}', 'update')->name('adminpetitions.update');
    Route::put('admin/petitions/status/{id}', 'changeStatus')->name('adminpetitions.estado');
});

Route::middleware('auth')->controller(AdminCategoryController::class)->group(function () {
    Route::get('admin/categories/index', 'index')->name('admincategories.index');
    Route::get('admin/category/{id}', 'show')->name('admincategories.show');
    Route::get('admin/categories/add', 'create')->name('admincategories.create');
    Route::get('admin/categories/edit/{id}', 'edit')->name('admincategories.edit');
    Route::post('admin/categories', 'store')->name('admincategories.store');
    Route::delete('admin/categories/{id}', 'delete')->name('admincategories.delete');
    Route::put('admin/categories/{id}', 'update')->name('admincategories.update');
});

Route::middleware('auth')->controller(AdminUserController::class)->group(function () {
    Route::get('admin/users/index', 'index')->name('adminusers.index');
    Route::get('admin/user/{id}', 'show')->name('adminusers.show');
    Route::get('admin/users/add', 'create')->name('adminusers.create');
    Route::get('admin/users/edit/{id}', 'edit')->name('adminusers.edit');
    Route::post('admin/users', 'store')->name('adminusers.store');
    Route::delete('admin/users/{id}', 'delete')->name('adminusers.delete');
    Route::put('admin/users/{id}', 'update')->name('adminusers.update');
});

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

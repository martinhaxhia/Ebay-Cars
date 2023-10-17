<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('admin/login','Auth\AdminAuthController@getLogin')->name('adminLogin');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin')->name('adminLoginPost');
Route::get('admin/logout', 'Auth\AdminAuthController@logout')->name('adminLogout');

Route::group(['prefix' => 'admin','middleware' => 'adminauth'], function () {
    // Admin Dashboard
    Route::get('dashboard','AdminController@dashboard')->name('dashboard');
});
/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::get('login', [UserController::class, 'index'])->name('login');
Route::get('Account', [UserController::class, 'singleUser'])->name('user.Account');
Route::get('Details', [UserController::class, 'userDetails'])->name('user.details');
Route::get('users.show', [UserController::class, 'show'])->name('customers');
Route::post('custom-login', [UserController::class, 'Login'])->name('login.custom');
Route::get('registration', [UserController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [UserController::class, 'userCreate'])->name('register.custom');
Route::get('signout', [UserController::class, 'signOut'])->name('signout');

/*
|--------------------------------------------------------------------------
| Car Routes Used by Admin
|--------------------------------------------------------------------------
*/
Route::get('restoreAll', [CarController::class, 'restoreAll'])->name('cars.restoreAll');
Route::get('restore/{id}', [CarController::class, 'restore'])->name('cars.restore');
Route::get('delete/{id}',[CarController::class,'delete'])->name('delete');
Route::get('cars.show', [CarController::class, 'show'])->name('cars');
/*
|--------------------------------------------------------------------------
| Cars Routes
|--------------------------------------------------------------------------
*/
Route::resource('cars', 'CarController');
Route::get('cars.search', [CarController::class, 'search'])->name('cars.search');/*

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::post('remove-from-cart/{id}', [CartController::class, 'remove'])->name('remove.from.cart');
Route::post('removeAll', [CartController::class, 'removeAll'])->name('clearCart');

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
Route::get('/', [CarController::class, 'index'])->name('cars');

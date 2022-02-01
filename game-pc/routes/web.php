<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin sources
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [HomeController::class, 'adminHome'])->name('adminPage');
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/Duser/{id}', [UsersController::class, 'destroy']);
    Route::get('/editUser/{id}', [UsersController::class, 'edit']);
    Route::get('/editAdmin/{id}', [UsersController::class, 'edit']);
    Route::put('/editUser/{user}', [UsersController::class, 'update'])->name('updateUser');
    Route::resource('categories', 'CategoryController');
    Route::get('/contactAdmin', [ContactUsController::class, 'index'])->name('messeges');
});

// edit or update profile
Route::get('/profile/{id}', [UsersController::class, 'editProfile'])->name('profile')->middleware('user');
Route::put('/profile/{user}', [UsersController::class, 'update'])->name('profileUpdate')->middleware('user');

// upload or delete image
Route::post('image-upload', [ UsersController::class, 'upload' ])->name('imageUpload')->middleware('user');
Route::put('/deleteImage/{id}', [ UsersController::class, 'deleteImage' ])->name('deleteImage');

// Change password
Route::post('change-password/{id}', [ UsersController::class, 'changePassword' ])->name('change.password');

// Log out
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Contact
Route::get('/contact', [ContactUsController::class, 'createForm']);
Route::post('/contact', [ContactUsController::class, 'ContactUsForm'])->name('contact.store');
Route::get('/Dmessege/{id}', [ContactUsController::class, 'destroy']);

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Show product
Route::get('/category/{name}', [HomeController::class, 'showProducts'])->name('products');

// Categories
Route::resource('categories', 'CategoryController')->only('index');

// Products
Route::resource('products', 'ProductsController' );

// Checkout
Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.success');

// compile pc
Route::get('/samenstellen', [CheckoutController::class, 'indexCompiling'])->name('compiling');
Route::post('/samenstellen', [CheckoutController::class, 'compiling'])->name('compile.success');

// Checkout admin
Route::get('/Bestelgeschiedenis', [CheckoutController::class, 'indexAdmin'])->name('history.index');
Route::Delete('/Bestelgeschiedenis/{checkout}', [CheckoutController::class, 'destroy'])->name('checkout.destroy');

// Checkout User
Route::get('/geschiedenis', [CheckoutController::class, 'indexUser'])->name('historyUser.index');

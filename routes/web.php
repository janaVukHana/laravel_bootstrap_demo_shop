<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/contact', function() {
    return view('contact');
});

Route::get('/about-us', function() {
    return view('about-us');
});

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::post('/{product}', [ProductController::class, 'addToCart']);
Route::get('/products/shopping-cart', [ProductController::class, 'shoppingCart'])->middleware('auth')->name('products.shopping-cart');
Route::post('/products/shopping-cart', [ProductController::class, 'checkout'])->middleware('auth');
Route::post('/products/shopping-cart/destroy', [ProductController::class, 'emptyCart'])->middleware('auth');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/admin/products', [AdminController::class, 'products'])->middleware(['auth', 'admin'])->name('admin.products');
Route::get('/admin/products/create', [AdminController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.products.create');
Route::post('/admin/products/create', [AdminController::class, 'store'])->middleware(['auth', 'admin']);
Route::get('/admin/products/edit/{product}', [AdminController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.products.edit');
Route::put('/admin/products/edit/{product}', [AdminController::class, 'update'])->middleware(['auth', 'admin']);
Route::delete('/admin/products/delete/{product}', [AdminController::class, 'destroy'])->middleware(['auth', 'admin']);

Route::get('/users/register', [UserController::class, 'create'])->name('users.create');
Route::post('/users/register', [UserController::class, 'store']);
Route::get('/users/login', [UserController::class, 'login'])->name('users.login');
Route::post('/users/login', [UserController::class, 'authenticate']);
Route::get('/users/logout', [UserController::class, 'logout']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
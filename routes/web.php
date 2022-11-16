<?php
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Mail\OrderMail;

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
Route::get('/email', function() {
    return new OrderMail();
});

Route::get('/contact', function() {
    return view('contact');
});

Route::get('/about-us', function() {
    return view('about-us');
});

// products pages and  shopping cart pages
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::post('/{product}', [ProductController::class, 'addToCart']);
Route::get('/products/shopping-cart', [ProductController::class, 'shoppingCart'])->name('products.shopping-cart');
Route::post('/products/shopping-cart', [ProductController::class, 'checkout'])->middleware('auth');
Route::get('/products/order', [ProductController::class, 'showOrderForm'])->middleware('auth')->name('products.order');
Route::post('/products/order', [ProductController::class, 'makeOrder'])->middleware('auth')->name('products.make-order');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/shopping-cart/destroy', [ProductController::class, 'emptyCart'])->middleware('auth');

// admin 
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'create'])->name('admin.products.create');
    Route::post('/products/create', [AdminController::class, 'store']);
    Route::get('/products/edit/{product}', [AdminController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/edit/{product}', [AdminController::class, 'update']);
    Route::delete('/products/delete/{product}', [AdminController::class, 'destroy']);
});

// register, login and logout functionality
Route::prefix('users')->group(function() {
    Route::get('/register', [UserController::class, 'create'])->middleware('guest')->name('users.create');
    Route::post('/register', [UserController::class, 'store'])->middleware('guest');
    Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('users.login');
    Route::post('/login', [UserController::class, 'authenticate'])->middleware('guest');
    Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');
});

// add comment to product
Route::post('/products/comment/add', [CommentController::class, 'addComment'])->middleware('auth')->name('products.comment.add');

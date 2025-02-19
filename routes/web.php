<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/lien-he', [\App\Http\Controllers\ContactController::class, 'index']);
Route::get('/gioi-thieu', [\App\Http\Controllers\AboutController::class, 'index']);
Route::post('/send', [\App\Http\Controllers\ContactController::class, 'sendMail']);
Route::get('/tin-tuc', [\App\Http\Controllers\NewsController::class, 'index']);
Route::get('/tin-tuc/{slug}', [\App\Http\Controllers\NewsController::class, 'detail']);
Route::get('/khach-hang', [\App\Http\Controllers\CustomerController::class, 'index']);
Route::get('/khach-hang-detail', [\App\Http\Controllers\CustomerController::class, 'detail'])->name('customer.detail');
Route::get('/khach-hang-more', [\App\Http\Controllers\CustomerController::class, 'loadMore'])->name('customer.loadMore');
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/danh-sach-tour', [App\Http\Controllers\ToursController::class, 'tours']);
Route::get('/chi-tiet-tour/{slug}', [App\Http\Controllers\ToursController::class, 'tour_detail']);
Route::post('/register-phone', [App\Http\Controllers\HomeController::class, 'register_phone']);
Route::post('/submit-booking', [\App\Http\Controllers\ToursController::class, 'booking']);
Route::get('/filter-tour', [\App\Http\Controllers\ToursController::class, 'filterTours']);

<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\SSEController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


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

//must login
Route::group(['middleware' => ['auth']], function () {

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');


});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/{id}', [EventController::class, 'event'])->name('event');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');


Route::get('test2', function () {
    return view('testing');
});

Route::get('/stream', [SSEController::class, 'stream'])->name('sse');
Route::get('/send-selected-stall', [SSEController::class, 'sendSelectedStall'])->name('sendSelectedStall');


Route::get('/event-data/{id}', [EventController::class, 'getEventData'])->name('event-data');

//Route::get('/event-timeslot/{id}', [EventController::class, 'getTimeSlots'])->name('event-timeslot');
//Route::get('/event-stall/{id}', [EventController::class, 'getStalls'])->name('event-stall');

Route::post('/make-payment', [StripeController::class, 'processTransaction'])->name('make-payment');
Route::get('/confirm-payment', [StripeController::class, 'successTransaction'])->name('confirm-payment');

// routes/web.php



Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});



<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\UserController;

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
	return view('welcome');
});



Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

	Route::post('/mark-as-read', [App\Http\Controllers\HomeController::class, 'markAsNotification'])->name('markAsNotification');


	Route::group(['prefix' => 'cuti', 'as' => 'cuti.'], function () {

		Route::get('/add', [CutiController::class, 'create'])->name('create');
		Route::post('/add', [CutiController::class, 'store'])->name('store');
		Route::get('/history', [CutiController::class, 'history'])->name('history');
		Route::get('/kelola', [CutiController::class, 'kelola'])->name('kelola');
		Route::get('/decline/{id}', [CutiController::class, 'decline'])->name('decline');
		Route::get('/accept/{id}', [CutiController::class, 'accept'])->name('accept');
	});

	Route::get('/notifications', [HomeController::class, 'notif'])->name('home.notif');


	Route::group(['prefix' => 'absen', 'as' => 'absen.'], function () {


		Route::post('/checkin', [AbsenController::class, 'checkin'])->name('checkin');
		Route::get('/absensi/filter', [AbsenController::class, 'filter'])->name('filter');
		Route::get('/absensi', [AbsenController::class, 'absensi'])->name('absensi');
		Route::get('/history', [AbsenController::class, 'history'])->name('history');
		Route::get('/search', [AbsenController::class, 'search'])->name('search');
	});


	Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
		
		Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
		Route::get('/list', [UserController::class, 'list'])->name('list');
		Route::get('/add', [UserController::class, 'add'])->name('create');
		Route::post('/add', [UserController::class, 'store'])->name('store');
		Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
		Route::post('/edit/{user}', [UserController::class, 'update'])->name('update');
		Route::get('/history', [UserController::class, 'history'])->name('history');
		Route::get('/reset', [UserController::class, 'resetView'])->name('respass');
		Route::post('/change', [UserController::class, 'change'])->name('pass');
	});

	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

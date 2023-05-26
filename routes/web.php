<?php

use App\Http\Controllers\AdminDashboard;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthConroller;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;

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
    return  redirect()->route('login');
});

Route::controller(AuthConroller::class)->group(function () {
    Route::middleware(RedirectIfAuthenticated::class)->group(function () {
        Route::get('/login', 'login_view')->name('login');
        Route::post('/login', 'login_process');
    });
    Route::get('/logout', 'logout')->name('logout');
});

Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard')->middleware(Authenticate::class);

Route::get('/create', function () {
    $data = [
        'name' => 'The Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('12345'),
    ];
    User::create($data);
    return redirect()->route('login');
});

<?php

use App\Http\Controllers\AdminDashboard;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthConroller;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TopicController;
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

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/select-subject', 'select_subject')->name('select.subject');
    Route::get('/select-topic/{subject:slug}', 'select_topic')->name('select.topic');
    Route::get('/questions/{topic:slug}', 'questions')->name('questions');
});

Route::controller(AuthConroller::class)->group(function () {
    Route::middleware(RedirectIfAuthenticated::class)->group(function () {
        Route::get('/login', 'login_view')->name('login');
        Route::post('/login', 'login_process');
    });
    Route::get('/logout', 'logout')->name('logout')->middleware(Authenticate::class);
});

Route::prefix('admin')->name('admin.')->middleware(Authenticate::class)->group(function () {

    Route::get('dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::controller(SubjectController::class)->group(function () {
        Route::get('subjects', 'index')->name('subjects');
        Route::get('subject/create', 'create')->name('subject.create');
        Route::post('subject/create', 'store');
        Route::get('subject/{subject}/edit', 'edit')->name('subject.edit');
        Route::post('subject/{subject}/edit', 'update');
        Route::get('subject/{subject}/delete', 'destroy')->name('subject.delete');
    });

    Route::controller(TopicController::class)->group(function () {
        Route::get('topics', 'index')->name('topics');
        Route::get('topic/create', 'create')->name('topic.create');
        Route::post('topic/create', 'store');
        Route::get('topic/{topic}/edit', 'edit')->name('topic.edit');
        Route::post('topic/{topic}/edit', 'update');
        Route::get('topic/{topic}/delete', 'destroy')->name('topic.delete');
    });

    Route::controller(QuestionController::class)->group(function () {
        Route::get('questions', 'index')->name('questions');
        Route::get('question/create', 'create')->name('question.create');
        Route::post('question/create', 'store');
        Route::get('question/{question}/edit', 'edit')->name('question.edit');
        Route::post('question/{question}/edit', 'update');
        Route::get('question/{question}/delete', 'destroy')->name('question.delete');
    });
});


Route::get('/create', function () {
    $data = [
        'name' => 'The Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('12345'),
    ];
    User::create($data);
    return redirect()->route('login');
});

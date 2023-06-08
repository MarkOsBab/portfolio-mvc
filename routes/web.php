<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaggableController;
use App\Http\Controllers\WebController;
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

Route::get('/', [WebController::class, 'index'])
    ->name('web');

Route::get('/dashboard', [TagController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

//Tags
Route::group([
    'prefix' => '/dashboard/tags',
    'middleware' => 'auth'
], function() {
    Route::controller(TagController::class)->group(function() {
        Route::get('/create', 'create')->name('tags.create');
        Route::post('/', 'store')->name('tags.store');
        Route::get('/{id}/edit', 'edit')->name('tags.edit');
        Route::put('/{id}', 'update')->name('tags.update');
        Route::delete('/{id}', 'destroy')->name('tags.destroy');
    });
});


// Proyects
Route::group([
    'prefix' => '/dashboard/projects',
    'middleware' => 'auth'
], function() {
    Route::controller(ProjectController::class)->group(function(){
        Route::get('/', 'index')->name('projects.index');
        Route::get('/create', 'create')->name('projects.create');
        Route::post('/', 'store')->name('projects.store');
        Route::get('/{id}/edit', 'edit')->name('projects.edit');
        Route::put('/{id}', 'update')->name('projects.update');
        Route::delete('/{id}', 'destroy')->name('projects.destroy');
    });
});

Route::group([
    'prefix' => '/dashboard/services',
    'middleware' => 'auth'
], function() {
    Route::controller(ServiceController::class)->group(function(){
        Route::get('/', 'index')->name('services.index');
        Route::get('/create', 'create')->name('services.create');
        Route::post('/', 'store')->name('services.store');
        Route::get('/{id}/edit', 'edit')->name('services.edit');
        Route::put('/{id}', 'update')->name('services.update');
        Route::delete('/{id}', 'destroy')->name('services.destroy');
    });
});

Route::group([
    'prefix' => '/dashboard/news',
    'middleware' => 'auth',
], function(){
    Route::controller(NewsController::class)->group(function(){
        Route::get('/', 'index')->name('news.index');
        Route::get('/create', 'create')->name('news.create');
        Route::post('/', 'store')->name('news.store');
        Route::get('/{id}/edit', 'edit')->name('news.edit');
        Route::put('/{id}', 'update')->name('news.update');
        Route::delete('/{id}', 'destroy')->name('news.destroy');
    });
});

Route::group([
    'prefix' => '/dashboard/taggable',
    'middleware' => 'auth',
], function() {
    Route::controller(TaggableController::class)->group(function(){
        Route::get('/{taggableType}/id/{taggableId}', 'create')->name('taggable.create');
        Route::post('/{taggableType}/id/{taggableId}', 'store')->name('taggable.store');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

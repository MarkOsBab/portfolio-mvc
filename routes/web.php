<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','verified'])->group(function(){
    Route::get('/dashboard', [NoteController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/note/show/{note}', [NoteController::class, 'show'])->name('dashboard.note.show');
    Route::get('/dashboard/note/create', [NoteController::class, 'create'])->name('dashboard.note.create');
    Route::post('/dashboard/note/store', [NoteController::class, 'store'])->name('dashboard.note.store');
    Route::get('/dashboard/note/{note}/edit', [NoteController::class, 'edit'])->name('dashboard.note.edit');
    Route::put('/dashboard/note/{note}/update', [NoteController::class, 'update'])->name('dashboard.note.update');
    Route::delete('/dashboard/note/{note}', [NoteController::class, 'destroy'])->name('dashboard.note.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

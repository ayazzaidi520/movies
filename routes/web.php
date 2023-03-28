<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Services\FilmService;
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
    return view('films.index');
});
Route::prefix('films')->as('films.')->group(function () {
    Route::get('/', function () {
        return view('films.index');
    })->name('index');
    Route::get('create', function () {
        return view('films.create');
    })->name('create');
    Route::get('{slug}', function (string $slug) {
        return view('films.show', ['film' => app(FilmService::class)->find($slug)]);
    })->name('show');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

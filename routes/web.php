<?php

use App\Http\Controllers\NotesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [NotesController::class, 'index'])
->name('index');

Route::group([
    'prefix' => 'notes',
    'as' => 'notes.',
], function () {
    Route::get('/', [NotesController::class, 'index'])
    ->name('home');

    Route::get('/{note}/edit', [NotesController::class, 'edit'])
    ->name('edit');

    Route::get('create', [NotesController::class, 'create'])
    ->name('create');

    Route::post('/store', [NotesController::class, 'store'])
    ->name('store');

    Route::delete('/{note}', [NotesController::class, 'destroy'])
    ->name('destroy');
});
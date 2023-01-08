<?php

use App\Http\Controllers\NotasController;
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

Route::get('/', [NotasController::class, 'index'])
->name('index');

Route::group([
    'prefix' => 'notas',
    'as' => 'notas.',
], function () {
    Route::get('/', [NotasController::class, 'index'])
    ->name('home');

    Route::get('/{nota}/edit', [NotasController::class, 'edit'])
    ->name('edit');

    Route::get('create', [NotasController::class, 'create'])
    ->name('create');

    Route::post('/store', [NotasController::class, 'store'])
    ->name('store');

    Route::delete('/{nota}', [NotasController::class, 'destroy'])
    ->name('destroy');
});
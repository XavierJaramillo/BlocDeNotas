<?php

use App\Http\Controllers\NotasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'notas',
    'as' => 'notas.',
], function () {
    Route::get('/getNotas/{pagina}', [NotasController::class, 'getNotas'])
    ->name('getNotas');

    Route::post('/search', [NotasController::class, 'search'])
    ->name('search');
});
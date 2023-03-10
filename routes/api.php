<?php

use App\Http\Controllers\NotesController;
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
    'prefix' => 'notes',
    'as' => 'notes.',
], function () {
    Route::get('/getNotes/{pagina}', [NotesController::class, 'getNotes'])
    ->name('getNotes');

    Route::post('/search', [NotesController::class, 'search'])
    ->name('search');
});
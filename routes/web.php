<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('webcomics/scrapeall', [App\Http\Controllers\WebcomicController::class, 'scrapeAll'])
        ->name('webcomics.scrapeall');

    Route::resource('webcomics', App\Http\Controllers\WebcomicController::class);
    Route::get('webcomics/{webcomic}/sources/create', [App\Http\Controllers\SourceController::class, 'create'])
        ->name('webcomics.sources.create');
    Route::post('webcomics/{webcomic}/sources', [App\Http\Controllers\SourceController::class, 'store'])
        ->name('webcomics.sources.store');
    Route::get('webcomics/{webcomic}/sources/{source}/scrape', [App\Http\Controllers\SourceController::class, 'scrape'])
        ->name('webcomics.sources.scrape');
    Route::get('webcomics/{webcomic}/sources/{source}/edit', [App\Http\Controllers\SourceController::class, 'edit'])
        ->name('webcomics.sources.edit');
    Route::patch('webcomics/{webcomic}/sources/{source}', [App\Http\Controllers\SourceController::class, 'update'])
        ->name('webcomics.sources.update');

});

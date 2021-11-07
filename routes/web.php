<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShortenedUrlController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('generate-shortened-url', [ShortenedUrlController::class, 'generateShortenedUrl'])->name('generate_shortened_url');
Route::post('get-shorten-url-info', [ShortenedUrlController::class, 'getShortenUrlInfo'])->name('get_shorten_url_info');


Route::get('{code}', [ShortenedUrlController::class, 'retrieveShortenUrl'])->name('retrieve_shorten_url');

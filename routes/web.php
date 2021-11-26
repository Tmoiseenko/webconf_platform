<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Request;
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

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::post('/joining', [App\Http\Controllers\UserTimeTreckerController::class, 'joining']);
Route::post('/leaving', [App\Http\Controllers\UserTimeTreckerController::class, 'leaving']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/chat', [ChatController::class, 'chat']);
    Route::post('/chat/send', [ChatController::class, 'storeChat']);

    Route::post('/chat/react', [ChatController::class, 'storeReact']);
    Route::post('/chat/image', [ChatController::class, 'storeImage']);
});


Route::group(['middleware' => 'access:manager'], function() {
    Route::get('/test', function(Request $request) {
        dd('ok');
    });
    Route::post('/chat/hide', [App\Http\Controllers\ChatController::class, 'banMessage']);
});


require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatisticsController;
use App\Models\Setting;
use Illuminate\Support\Carbon;
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

Route::post('/joining', [StatisticsController::class, 'joining']);
Route::post('/leaving', [StatisticsController::class, 'leaving']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/chat', [ChatController::class, 'chat']);
    Route::post('/chat/send', [ChatController::class, 'storeChat']);

    Route::post('/chat/react', [ChatController::class, 'storeReact']);
    Route::post('/chat/image', [ChatController::class, 'storeImage']);
});


Route::group(['middleware' => 'access:administrator'], function() {
    Route::get('/test', function(Request $request) {
        $now = Carbon::now();
        $event = Setting::first();
        $start = Carbon::parse($event->start_time);
        $end = Carbon::parse($event->end_time);
        dd($now >= $start && $now <= $end);
    });
    Route::post('/chat/hide', [App\Http\Controllers\ChatController::class, 'banMessage']);
});


require __DIR__.'/auth.php';

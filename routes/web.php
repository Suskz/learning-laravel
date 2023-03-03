<?php

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

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);
//create -- create DB
Route::get('/events/create', [EventController::class, 'create']);
//show -- specifics dates
Route::get('/events/{id}', [EventController::class, 'show']);
//store -- send DB
Route::post('/events', [EventController::class, 'store']);

Route::get('/contato', function () {
    return view('contact');
});
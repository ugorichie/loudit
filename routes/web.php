<?php

use App\Http\Controllers\loudController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


## BELOW ARE THE MAIN ROUTES
////////////////-- 

Route::get('/', function(){
    return view('home');
})->name('home');

Route::get('/terms', function(){
    return view('terms');
});

Route::post('/loud', [loudController::class, 'create_loud'])-> name('loud.create');


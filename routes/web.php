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

// Route::get('/', function(){
//     return view('home');
// })->name('home');

Route::get('/terms', function(){
    return view('terms');
});

Route::get('/', [loudController::class, 'get_all_louds'])-> name('loud.index'); //-> HOME PAGE

Route::get('/home/{id}', [loudController::class, 'get_single_loud'])-> name('loud.show'); //-> TO SHOW SINGLE

Route::post('/create-loud', [loudController::class, 'create_loud'])-> name('loud.create'); //-> TO CREATE 

Route::delete('/delete-loud/{id}', [loudController::class, 'delete_loud'])-> name('loud.delete'); //-> TO DELETE


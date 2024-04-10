<?php

use App\Http\Controllers\dashboard;
use App\Http\Controllers\loudController;
use App\Http\Controllers\userController;
use App\Http\Controllers\CommentController;

use App\Models\comment;
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
})->name('terms');

##########################
##############
// LOUD ROUTES

Route::get('/', [loudController::class, 'get_all_louds'])-> name('loud.index'); //-> HOME PAGE


###This is how to group route with same 'links/prefix' and also we can group with same 'as/name' 
Route::group(['prefix'=>'/home'], function(){

    Route::post('/loud-create', [loudController::class, 'create_loud'])-> name('loud.create'); //-> TO CREATE 
    
    Route::get('/{id}', [loudController::class, 'get_single_loud'])-> name('loud.show'); //-> TO SHOW SINGLE
    
    Route::get('/{id}/edit', [loudController::class, 'get_single_loud_edit'])-> name('loud.edit'); //-> TO SHOW SINGLE FOR EDITING
    
    Route::post('/{id}/update', [loudController::class, 'get_single_loud_update'])-> name('loud.update'); //-> TO SHOW SINGLE FOR EDITING
    
    
    Route::delete('/delete/{id}', [loudController::class, 'delete_loud'])-> name('loud.delete'); //-> TO DELETE
});




#############################
###################
// COMMENTS ROUTES
Route::post('/loud/{id}/comment', [CommentController::class, 'create_comment'])-> name('comment.create')->middleware('auth'); //-> TO CREATE A COMMENT



###########################
########################
//REGISTER ROUTE
Route::get('/register', function(){
    return view('register');
})->name('user.registerpage');

Route::post('/profile/create', [UserController::class, 'create_user'])-> name('user.create'); //-> TO CREATE 



############################
########################
//LOGIN ROUTE
Route::get('/login', function(){
    return view('login');
})->name('login');


Route::group(['prefix'=>'/profile', 'as'=>'user.'], function(){

    Route::post('/login', [UserController::class, 'login_user'])-> name('login'); //-> TO LOGIN
    
    Route::post('/logout', [UserController::class, 'logout_user'])-> name('logout'); //-> TO LOGOUT
});



//implementing search button
//Route::get('/', [dashboard::class, 'index'])-> name('search'); //-> DO THE SEARCH FILTER IN THE KITCHEN

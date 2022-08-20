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


/*
Route::get('/marenge', function(){
    return view('pages.about');
});

Route::get('/', function(){
    return view('welcome');
});


Route::get('/marenge/{id}/{name}', function($id, $name){
    return 'This is '.$id.' With a name of '.$name;
});

*/

Route::get('/', 'App\Http\Controllers\PagesController@index');
Route::get('/about', 'App\Http\Controllers\PagesController@about');
Route::get('/services', 'App\Http\Controllers\PagesController@services');
Route::resource('posts', 'App\Http\Controllers\PostsController');



Auth::routes();

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
//Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');





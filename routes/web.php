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


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function(){
    return view('admin.login');
})->name('signin');



Route::post('login', 'HomeController@log')->name('log');
Route::post('log_out', 'HomeController@user_logout')->name('user_logout');

Route::get('profile', function(){
    return view('admin.profile');
})->name('profile');

Route::group(['middleware' => ['auth', 'locale']], function () {

    Route::get('dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::get('switch_language/{locale}', function ($locale) {
        session()->put('locale', $locale);
        \App::setLocale(session()->get('locale'));
        return redirect()->back();
    })->name('switch_language');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::put('update_profile/{id}', 'HomeController@update_profile')->name('update_profile');
});
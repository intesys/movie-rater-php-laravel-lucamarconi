<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::redirect('/', '/movies');

Route::resource('movies', MovieController::class);

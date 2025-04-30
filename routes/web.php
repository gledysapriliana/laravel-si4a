<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil', function () {
    return view('profil');
});

use App\Http\Controllers\FakultasController;

Route::resource('/fakultas', FakultasController::class);
<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barbers', function () {
    return Inertia::render('Barbers');
});

Route::get('/appointments', function () {
    return Inertia::render('Appointments');
});
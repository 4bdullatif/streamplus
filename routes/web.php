<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('register');
});

Route::get('/register', function () {
    return view('register');
})->name('register');


Route::get('/countries-list', CountryController::class)->name('countries-list');
Route::get('/states-list', StateController::class)->name('states-list');
Route::get('/customer/{customer}', [CustomerController::class, 'show'])->name('customer.show');

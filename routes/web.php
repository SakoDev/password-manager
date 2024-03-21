<?php

use App\Livewire\Account\AccountIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/account', function () {
        return view('account');
    })->name('account');
    Route::get('/accounts',AccountIndex::class)->name('account-index');

});

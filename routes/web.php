<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventViewController;

Route::get('/events', [EventViewController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventViewController::class, 'create'])->name('events.create');
Route::post('/events', [EventViewController::class, 'store'])->name('events.store');
Route::delete('/events/{id}', [EventViewController::class, 'destroy'])->name('events.destroy');
Route::get('/login', [EventViewController::class, 'login'])->name('login');
Route::post('/authenticate', [EventViewController::class, 'authenticate'])->name('authenticate');
;

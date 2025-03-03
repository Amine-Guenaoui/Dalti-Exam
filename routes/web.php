<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect(route('services.index'));
});

Route::resource('services', ServiceController::class);


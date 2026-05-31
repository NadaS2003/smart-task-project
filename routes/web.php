<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('tasks', TaskController::class);
Route::put('/updateStatus/{id}',[TaskController::class,'updateStatus'])->name('tasks.updateStatus');


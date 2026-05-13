<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::resource('tasks', TaskController::class);

Route::patch('tasks/{task}/complete', [TaskController::class, 'toggleComplete'])->name('tasks.complete');

Route::resource('categories', CategoryController::class)->except(['show']);
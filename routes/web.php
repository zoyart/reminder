<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::get('/', [TasksController::class, 'index'])->name('index');

Route::post('/create-board', [TasksController::class, 'createBoard'])->name('createBoard');
Route::post('/create-task', [TasksController::class, 'createTask'])->name('createTask');

Route::delete('/delete-board', [TasksController::class, 'deleteBoard'])->name('deleteBoard');
Route::delete('/delete-task', [TasksController::class, 'deleteTask'])->name('deleteTask');

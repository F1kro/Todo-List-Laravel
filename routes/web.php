<?php

use App\Http\Controllers\Todo\TodoController as TodoTodoController;
use Illuminate\Support\Facades\Route;

Route::get('/todo', [TodoTodoController::class, 'index'])->name('todo');
Route::post('/todo', [TodoTodoController::class, 'store'])->name('todo.post');
Route::put('/todo/{id}', [TodoTodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{id}', [TodoTodoController::class, 'destroy'])->name('todo.delete');

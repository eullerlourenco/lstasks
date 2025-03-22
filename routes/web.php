<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::controller(TaskController::class)
    ->prefix('tasks')
    ->middleware('auth')
    ->name('tasks.')
    ->group(function () {

        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');

        Route::get('/{task}/edit', 'edit')->name('edit');
        Route::put('/{task}', 'update')->name('update');

        Route::delete('/{task}/delete', 'destroy')->name('destroy');

        Route::patch('/{task}/complete', 'complete')->name('complete');
        Route::patch('/{task}/reopen', 'reopen')->name('reopen');
    });


Route::controller(UserController::class)
    ->prefix('users')
    ->middleware('auth')
    ->name('users.')
    ->group(function () {

        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::put('/{user}', 'update')->name('update');
    });

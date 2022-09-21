<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::put('/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');
Route::delete('/users/{user}/destroy', [UserController::class , 'destroy'])->middleware('role:admin')->name('user.destroy');


Route::middleware(['role:admin', 'auth'])->group(function(){

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

});

Route::middleware(['auth', 'can:view,user'])->group(function(){

    Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');

});
?>
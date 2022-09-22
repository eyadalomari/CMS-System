<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;



Route::get('/roles', [RoleController::class, 'index'])->name('role.index');

Route::post('/roles', [RoleController::class, 'store'])->name('role.store');


Route::delete('/roles/{role}/destroy', [RoleController::class, 'destroy'])->name('role.destroy');

Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');

Route::put('/roles/{role}/update', [RoleController::class, 'update'])->name('role.update');

?>
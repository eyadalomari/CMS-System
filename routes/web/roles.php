<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;



Route::get('/roles', [RoleController::class, 'index'])->name('role.index');

?>
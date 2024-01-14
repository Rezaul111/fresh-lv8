<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;


Route::get('/dashboard',[DashboardController::class,'index']);
Route::resource('/resources',ResourceController::class);
Route::resource('/permissions',PermissionController::class);
Route::resource('/roles',RoleController::class);
Route::resource('/users',UserController::class);
Route::get('/user-status/{id}',[UserController::class,'status']);





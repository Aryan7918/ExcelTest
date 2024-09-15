<?php

use App\Http\Controllers\HolidayController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HolidayController::class,'index'])->name('welcome');
Route::post('importExcel',[HolidayController::class,'import'])->name('importExcel');
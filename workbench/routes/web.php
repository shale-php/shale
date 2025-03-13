<?php

use Illuminate\Support\Facades\Route;
use Workbench\App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

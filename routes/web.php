<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSOController;

Route::get('/sso-login', [SSOController::class, 'ssoLogin']);
Route::get('/dashboard', [SSOController::class, 'dashboard'])->middleware('auth');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSOController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [SSOController::class, 'index']);
Route::get('/sso-login', [SSOController::class, 'ssoLogin']);
Route::get('/dashboard', [SSOController::class, 'dashboard']);
Route::post('/sso-logout', [SSOController::class, 'ssoLogout'])->name('sso.logout');
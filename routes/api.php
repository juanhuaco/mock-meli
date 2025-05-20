<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/orders/{orderId}', [ApiController::class, 'getOrder']);
Route::post('/oauth/token', [ApiController::class, 'refreshToken']);

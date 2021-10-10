<?php

use Illuminate\Support\Facades\Route;
use JacobHyde\Tickets\App\Http\Controllers\Api\CategoryController;
use JacobHyde\Tickets\App\Http\Controllers\Api\TicketController;

Route::get('ticket/category', [CategoryController::class, 'index']);
Route::post('ticket', [TicketController::class, 'store']);
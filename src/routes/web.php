<?php

use Illuminate\Support\Facades\Route;
use JacobHyde\Tickets\App\Http\Controllers\CommentController;
use JacobHyde\Tickets\App\Http\Controllers\TicketController;

Route::group(['middleware' => 'support'], function () {
    Route::get('/', [TicketController::class, 'index'])->name('tickets.index');
    Route::put('ticket/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
});
Route::get('ticket/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
Route::post('ticket/comment', [CommentController::class, 'store'])->name('tickets.comment');
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notes', [\App\Http\Controllers\Api\NotesController::class, 'index']);
Route::post('/notes', [\App\Http\Controllers\Api\NotesController::class, 'store']);

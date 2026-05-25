<?php

use App\Http\Controllers\Api\NotesController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/notes', [NotesController::class, 'index']);
Route::post('/notes', [NotesController::class, 'store']);

Route::get('/', function () {
    return view('layouts.order');
});

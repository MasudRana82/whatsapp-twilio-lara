<?php

use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('whatsapp',([WhatsappController::class,'index']));
Route::post('whatsapp',([WhatsappController::class,'store']))->name('whatsapp.post');

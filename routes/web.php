<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return redirect()->route('items.index');
});

Route::resource('items', ItemController::class);

Route::patch('items/{item}/verify', [ItemController::class, 'verify'])->name('items.verify');

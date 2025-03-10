<?php

use App\Livewire\HomePage;
use App\Livewire\UnitPage;
use Illuminate\Support\Facades\Route;

Route::localized(function () {

    Route::get('/', HomePage::class)->name('home');
    Route::get('/departamento-en-venta/{name}', UnitPage::class)->name('unit');

});
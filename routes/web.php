<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Expedientes\ShowExpedientes;
use App\Livewire\Expedientes\ShowExpediente;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    // Ruta principal de clientes
    Route::view('clientes', 'clientes')->name('clientes');

    // Rutas de expedientes
    Route::get('/clientes/{id_cliente}/expedientes', ShowExpedientes::class)
        ->name('expedientes.show');

        Route::get('/expedientes/{hash}/{id_cliente}', ShowExpediente::class)
        ->name('expediente');
});

// Ruta del perfil
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

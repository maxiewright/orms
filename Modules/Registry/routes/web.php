<?php

use Illuminate\Support\Facades\Route;
use Modules\Registry\Http\Controllers\RegistryController;

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::resource('registries', RegistryController::class)->names('registry');
});

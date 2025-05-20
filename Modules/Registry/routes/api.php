<?php

use Illuminate\Support\Facades\Route;
use Modules\Registry\Http\Controllers\RegistryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function (): void {
    Route::apiResource('registries', RegistryController::class)->names('registry');
});

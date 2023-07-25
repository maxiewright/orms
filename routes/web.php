<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('sos', function () {

    $serviceperson = \App\Models\Serviceperson::find(198);

    $sos = new \App\Actions\GetCompulsoryRetirementAgeAction;

    return $sos(\App\Enums\RankEnum::O4, $serviceperson->date_of_birth);
});
//Route::prefix('filament')->as('filament.')->group(function (){
//    Route::prefix('pages')->as('pages.')->group(function (){
//        Route::get('my-profile', \App\Filament\Pages\MyProfile::class)
//        ->name('my-profile');
//    });
//});

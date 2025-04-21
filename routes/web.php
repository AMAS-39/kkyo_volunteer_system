<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VolunteerController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chairwoman', [DashboardController::class, 'chairwoman'])->name('dashboard.chairwoman');
    Route::get('/dashboard/head', [DashboardController::class, 'head'])->name('dashboard.head');
    Route::resource('volunteers', VolunteerController::class)->except(['edit', 'update', 'show']);
    Route::get('volunteers/{id}/points', [VolunteerController::class, 'addPointsForm'])->name('volunteers.points');
Route::post('volunteers/{id}/points', [VolunteerController::class, 'storePoints'])->name('volunteers.points.store');
Route::get('volunteers/{id}/history', [VolunteerController::class, 'viewHistory'])->name('volunteers.history');


});



require __DIR__.'/auth.php';

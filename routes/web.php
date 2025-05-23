<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VolunteerController;
use App\Models\Volunteer;
use App\Models\PointHistory;
use App\Imports\VolunteersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chairwoman', [DashboardController::class, 'chairwoman'])->name('dashboard.chairwoman');
    Route::get('/dashboard/head', [DashboardController::class, 'head'])->name('dashboard.head');

    // ✅ Moved and renamed prefix to avoid conflict
    Route::get('/bulk-points', [VolunteerController::class, 'bulkAddPointsForm'])->name('volunteers.bulk.points.form');
    Route::post('/bulk-points', [VolunteerController::class, 'storeBulkPoints'])->name('volunteers.bulk.points.store');

    Route::resource('volunteers', VolunteerController::class)->except(['edit', 'update', 'show']);

    Route::get('volunteers/{id}/points', [VolunteerController::class, 'addPointsForm'])->name('volunteers.points');
    Route::post('volunteers/{id}/points', [VolunteerController::class, 'storePoints'])->name('volunteers.points.store');
    Route::get('volunteers/{id}/history', [VolunteerController::class, 'viewHistory'])->name('volunteers.history');
});


// Utilities
Route::get('/check-volunteers', function () {
    return Volunteer::all();
});

Route::get('/check-points', function () {
    return PointHistory::all();
});

// Excel Import
Route::get('/import-volunteers', function () {
    return view('import');
});

Route::post('/import-volunteers', function (Request $request) {
    Excel::import(new VolunteersImport, $request->file('file'));
    return 'Volunteers Imported!';
});

require __DIR__.'/auth.php';

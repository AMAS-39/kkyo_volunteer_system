<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VolunteerController;
use App\Models\Volunteer;
use App\Models\PointHistory;
use App\Imports\VolunteersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Logout route (authenticated users)
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Guest routes (only for unauthenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    // Add register or password reset routes here if needed
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chairwoman', [DashboardController::class, 'chairwoman'])->name('dashboard.chairwoman');
    Route::get('/dashboard/head', [DashboardController::class, 'head'])->name('dashboard.head');

    // Volunteers routes
    Route::get('volunteers/bulk-points', [VolunteerController::class, 'bulkAddPointsForm'])->name('volunteers.bulk.points.form');
    Route::post('volunteers/bulk-points', [VolunteerController::class, 'storeBulkPoints'])->name('volunteers.bulk.points.store');

    Route::resource('volunteers', VolunteerController::class)->except(['edit', 'update', 'show']);

    Route::get('volunteers/{id}/points', [VolunteerController::class, 'addPointsForm'])->name('volunteers.points');
    Route::post('volunteers/{id}/points', [VolunteerController::class, 'storePoints'])->name('volunteers.points.store');
    Route::get('volunteers/{id}/history', [VolunteerController::class, 'viewHistory'])->name('volunteers.history');

    // Excel import routes
    Route::get('/import-volunteers', function () {
        return view('import');
    })->name('import.volunteers.form');

    Route::post('/import-volunteers', function (Request $request) {
        Excel::import(new VolunteersImport, $request->file('file'));
        return redirect()->back()->with('success', 'Volunteers Imported!');
    })->name('import.volunteers.store');

    // Utility routes (consider removing or securing better in production)
    Route::get('/check-volunteers', function () {
        return Volunteer::all();
    });

    Route::get('/check-points', function () {
        return PointHistory::all();
    });
});

require __DIR__.'/auth.php';

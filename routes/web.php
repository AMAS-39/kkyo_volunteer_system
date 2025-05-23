<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\AuthController;
use App\Models\Volunteer;
use App\Models\PointHistory;
use App\Imports\VolunteersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('login');
});

// Guest routes (only for unauthenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    // Add register or password reset routes here if needed
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chairwoman', [DashboardController::class, 'chairwoman'])->name('dashboard.chairwoman');
    Route::get('/dashboard/head', [DashboardController::class, 'head'])->name('dashboard.head');

    // Volunteers routes with prefix
    Route::prefix('volunteers')->group(function () {
        // Bulk points routes
        Route::get('/bulk-points', [VolunteerController::class, 'bulkAddPointsForm'])->name('volunteers.bulk.points.form');
        Route::post('/bulk-points', [VolunteerController::class, 'storeBulkPoints'])->name('volunteers.bulk.points.store');

        // Resource routes except edit, update, show
        Route::resource('/', VolunteerController::class)->parameters(['' => 'volunteer'])->except(['edit', 'update', 'show']);

        // Additional volunteer-specific routes
        Route::get('{id}/points', [VolunteerController::class, 'addPointsForm'])->name('volunteers.points');
        Route::post('{id}/points', [VolunteerController::class, 'storePoints'])->name('volunteers.points.store');
        Route::get('{id}/history', [VolunteerController::class, 'viewHistory'])->name('volunteers.history');
    });

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect based on role
        switch ($user->role) {
            case 1:
                return view('dashboard.chairwoman'); // Full access
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
                return view('dashboard.head'); // Heads
            default:
                abort(403); // Unknown role
        }
    }


    public function chairwoman()
{
    return view('dashboard.chairwoman');
}

public function head()
{
    return view('dashboard.head');
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PointHistory;

class VolunteerController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 1) {
            $volunteers = Volunteer::all(); // Chairwoman sees all
        } else {
            $volunteers = Volunteer::where('department_code', $user->department_code)->get(); // Head sees own dept
        }

        return view('volunteers.index', compact('volunteers'));
    }

    public function create()
    {
        return view('volunteers.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'phone' => 'required|regex:/^[0-9+\-\s]{7,15}$/|unique:volunteers,phone',

    ]);

    $user = Auth::user();

    // Auto-generate user code based on department
    $departmentCode = $user->role === 1 ? $request->department_code : $user->department_code;
    $lastCode = Volunteer::where('department_code', $departmentCode)->max('user_code') ?? $departmentCode;
    $newCode = $lastCode + 1;

    Volunteer::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'user_code' => $newCode,
        'department_code' => $departmentCode,
        'points' => 0,
    ]);

    return redirect()->route('volunteers.index')->with('success', 'Volunteer added successfully.');
}


    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return back()->with('success', 'Volunteer removed.');
    }



public function addPointsForm($id)
{
    $volunteer = Volunteer::findOrFail($id);
    return view('volunteers.add_points', compact('volunteer'));
}

public function storePoints(Request $request, $id)
{
    $request->validate([
        'points' => 'required|integer',
        'reason' => 'required|string|max:255',
    ]);

    $volunteer = Volunteer::findOrFail($id);

    // Save point history
    PointHistory::create([
        'volunteer_id' => $volunteer->id,
        'points' => $request->points,
        'reason' => $request->reason,
        'added_by' => Auth::id(),
    ]);

    // Update current point total
    $volunteer->increment('points', $request->points);

    return redirect()->route('volunteers.index')->with('success', 'Points updated successfully.');
}
public function viewHistory($id)
{
    $volunteer = Volunteer::findOrFail($id);
    $history = $volunteer->pointHistories()->with('addedBy')->latest()->get();

    return view('volunteers.history', compact('volunteer', 'history'));
}


}

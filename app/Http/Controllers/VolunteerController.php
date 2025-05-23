<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\PointHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Volunteer::query();

        if ($user->role != 1) {
            $query->where('department_code', $user->department_code);
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%")
                  ->orWhere('user_code', 'like', "%$search%");
            });
        }

        $volunteers = $query->get();

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
        $user = Auth::user();

        // Role check: Head can only update their own department
        if ($user->role != 1 && $user->department_code != $volunteer->department_code) {
            abort(403, 'You are not allowed to update this volunteer.');
        }

        PointHistory::create([
            'volunteer_id' => $volunteer->id,
            'points' => $request->points,
            'reason' => $request->reason,
            'added_by' => $user->id,
        ]);

        $volunteer->increment('points', $request->points);

        return redirect()->route('volunteers.index')->with('success', 'Points updated successfully.');
    }

    public function viewHistory($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        $history = $volunteer->pointHistories()->with('addedBy')->latest()->get();

        return view('volunteers.history', compact('volunteer', 'history'));
    }

    public function bulkAddPointsForm()
    {
        $user = Auth::user();

        if ($user->role == 1) {
            $volunteers = Volunteer::all();
        } else {
            $volunteers = Volunteer::where('department_code', $user->department_code)->get();
        }

        return view('volunteers.bulk-points', compact('volunteers'));
    }

    public function storeBulkPoints(Request $request)
    {
        $request->validate([
            'user_codes' => 'required|array',
            'points' => 'required|integer',
            'reason' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        foreach ($request->user_codes as $code) {
            $volunteer = Volunteer::where('user_code', trim($code))->first();

            if (!$volunteer) continue;

            if ($user->role != 1 && $user->department_code != $volunteer->department_code) {
                continue; // silently skip invalid targets
            }

            PointHistory::create([
                'volunteer_id' => $volunteer->id,
                'points' => $request->points,
                'reason' => $request->reason,
                'added_by' => $user->id,
            ]);

            $volunteer->increment('points', $request->points);
        }

        return back()->with('success', 'Points added to valid volunteers!');
    }
}

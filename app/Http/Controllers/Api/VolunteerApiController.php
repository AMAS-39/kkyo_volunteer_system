<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerApiController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'volunteers' => 'required|array',
            'volunteers.*.name' => 'required|string',
            'volunteers.*.phone' => 'required|string|unique:volunteers,phone',
            'volunteers.*.department_code' => 'required|integer',
        ]);

        foreach ($request->volunteers as $data) {
            $lastCode = Volunteer::where('department_code', $data['department_code'])->max('user_code') ?? $data['department_code'];
            $newCode = $lastCode + 1;

            Volunteer::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'department_code' => $data['department_code'],
                'user_code' => $newCode,
                'points' => 0,
            ]);
        }

        return response()->json(['message' => '✅ Volunteers added successfully']);
    }
}

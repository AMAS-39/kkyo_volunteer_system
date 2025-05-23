<?php

namespace App\Imports;

use App\Models\Volunteer;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class VolunteersImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $departmentCodes = [
            'technology' => 200,
            'culture' => 300,
            'education' => 400,
            'media' => 500,
            'economy' => 600,
        ];

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Skip header

            $name = trim($row[0]);
            $departmentRaw = strtolower(trim($row[1]));
            $phone = trim($row[2]);

            // Try to find department code by checking if raw department name contains any known keyword
            $departmentCode = null;
            foreach ($departmentCodes as $key => $code) {
                if (Str::contains($departmentRaw, $key)) {
                    $departmentCode = $code;
                    break;
                }
            }

            // Optional Debug
            // dump("Row $index → Name: $name | Dept: $departmentRaw | Phone: $phone | Matched Code: $departmentCode");

            if (!$name || !$phone || !$departmentCode) continue;

            // Skip if phone already exists
            if (Volunteer::where('phone', $phone)->exists()) continue;

            $lastUserCode = Volunteer::where('department_code', $departmentCode)
                                     ->max('user_code');
            $newUserCode = $lastUserCode ? $lastUserCode + 1 : $departmentCode + 1;

            Volunteer::create([
                'name' => $name,
                'phone' => $phone,
                'department_code' => $departmentCode,
                'user_code' => $newUserCode,
            ]);
        }
    }
}

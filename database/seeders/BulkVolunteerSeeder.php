<?php

namespace Database\Seeders;

use App\Models\Volunteer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BulkVolunteerSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/KKYO_Cleaned_Contact_Info_CLEANED.csv');
        if (!file_exists($path)) {
            $this->command->error("File not found: $path");
            return;
        }

        $file = fopen($path, 'r');
stream_filter_append($file, 'convert.iconv.ISO-8859-1/UTF-8');

        $header = fgetcsv($file); // Skip header

        $inserted = 0;
        $existingPhones = Volunteer::pluck('phone')->toArray();
        $userCodes = Volunteer::select('department_code', DB::raw('MAX(user_code) as max_code'))
                        ->groupBy('department_code')->pluck('max_code', 'department_code')->toArray();

        while (($data = fgetcsv($file)) !== false) {
            // ✅ Skip if the row doesn't have 3 columns
            if (count($data) < 3) {
                continue;
            }

            [$name, $phone, $department_code] = $data;

            if (in_array($phone, $existingPhones)) {
                continue;
            }

            $department_code = intval($department_code);
            $lastCode = $userCodes[$department_code] ?? $department_code;
            $newCode = $lastCode + 1;

            Volunteer::create([
                'name' => $name,
                'phone' => $phone,
                'department_code' => $department_code,
                'user_code' => $newCode,
                'points' => 0,
            ]);

            $userCodes[$department_code] = $newCode;
            $inserted++;
        }

        fclose($file);
        $this->command->info("✅ Inserted $inserted volunteers.");
    }
}

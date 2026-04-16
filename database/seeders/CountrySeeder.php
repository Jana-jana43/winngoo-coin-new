<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/countries.json');

        if (!File::exists($path)) {
            $this->command->error('countries.json not found');
            return;
        }

        $raw = json_decode(File::get($path), true);

        DB::table('countries')->truncate();

        // 🔹 Country specific overrides
        $specialCountries = [
            'IN' => [
                'phone_min' => 10,
                'phone_max' => 10,
                'postal_regex' => '^[1-9][0-9]{5}$',
            ],
            'GB' => [
                'phone_min' => 10,
                'phone_max' => 15,
                'postal_regex' => '^[A-Z]{1,2}\d[A-Z\d]? ?\d[A-Z]{2}$',
            ],
            'US' => [
                'phone_min' => 10,
                'phone_max' => 10,
                'postal_regex' => '^\d{5}(-\d{4})?$',
            ],
            'LK' => [
                'phone_min' => 9,
                'phone_max' => 10,
                'postal_regex' => '^\d{5}$',
            ],
            'MY' => [
                'phone_min' => 9,
                'phone_max' => 11,
                'postal_regex' => '^\d{5}$',
            ],
            'GH' => [
                'phone_min' => 9,
                'phone_max' => 9,
                'postal_regex' => '^\d{5}$',
            ],
            'SG' => [
                'phone_min' => 8,
                'phone_max' => 8,
                'postal_regex' => '^\d{6}$',
            ],
        ];

        foreach ($raw as $c) {

            $iso = $c['cca2'] ?? null;

            // 🔹 Default values
            $phoneMin = 6;
            $phoneMax = 15;
            $postalRegex = null;

            // 🔹 Override only for selected countries
            if ($iso && isset($specialCountries[$iso])) {
                $phoneMin = $specialCountries[$iso]['phone_min'];
                $phoneMax = $specialCountries[$iso]['phone_max'];
                $postalRegex = $specialCountries[$iso]['postal_regex'];
            }

            DB::table('countries')->insert([
                'name' => $c['name']['common'],
                'iso_code' => $iso,
                'phone_code' => isset($c['idd']['root'])
                    ? $c['idd']['root'] . ($c['idd']['suffixes'][0] ?? '')
                    : '',
                'phone_min' => $phoneMin,
                'phone_max' => $phoneMax,
                'postal_regex' => $postalRegex,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Countries seeded with phone & postal rules');
    }
}
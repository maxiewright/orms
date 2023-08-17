<?php

namespace Database\Seeders;

use App\Models\Metadata\Rank;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [
            [
                'name' => 'E1',
                'regiment' => 'Recruit',
                'regiment_abbreviation' => 'Rec',
                'coast_guard' => 'Recruit',
                'coast_guard_abbreviation' => 'Rec',
                'air_guard' => 'Recruit',
                'air_guard_abbreviation' => 'Rec',
            ],
            [
                'name' => 'E2',
                'regiment' => 'Private',
                'regiment_abbreviation' => 'Pte',
                'coast_guard' => 'Ordinary Rate',
                'coast_guard_abbreviation' => 'OR',
                'air_guard' => '{"Non-Technical":"Junior Aircraftman", "Technical": "Junior Technician"}',
                'air_guard_abbreviation' => '{"Non-Technical":"JAC", "Technical": "JT"}',
            ],
            [
                'name' => 'E3',
                'regiment' => 'Lance Corporal',
                'regiment_abbreviation' => 'LCpl',
                'coast_guard' => 'Able Rate',
                'coast_guard_abbreviation' => 'AR',
                'air_guard' => '{"Non-Technical":"Senior Aircraftman", "Technical": "Senior Technician"}',
                'air_guard_abbreviation' => '{"Non-Technical":"SAC", "Technical": "ST"}',
            ],
            [
                'name' => 'E4',
                'regiment' => 'Corporal',
                'regiment_abbreviation' => 'Cpl',
                'coast_guard' => 'Leading Rate',
                'coast_guard_abbreviation' => 'LR',
                'air_guard' => 'Corporal',
                'air_guard_abbreviation' => 'Cpl',
            ],
            [
                'name' => 'E5',
                'regiment' => 'Sergeant',
                'regiment_abbreviation' => 'Sgt',
                'coast_guard' => 'Petty Officer',
                'coast_guard_abbreviation' => 'PO',
                'air_guard' => 'Sergeant',
                'air_guard_abbreviation' => 'Sgt',
            ],
            [
                'name' => 'E6',
                'regiment' => 'Staff Sergeant',
                'regiment_abbreviation' => 'SSgt',
                'coast_guard' => 'No equivalent',
                'coast_guard_abbreviation' => 'No equivalent',
                'air_guard' => 'No equivalent',
                'air_guard_abbreviation' => 'No equivalent',
            ],
            [
                'name' => 'E7',
                'regiment' => 'Warrant Officer Class 2',
                'regiment_abbreviation' => 'WO2',
                'coast_guard' => 'Chief Petty Officer',
                'coast_guard_abbreviation' => 'CPO',
                'air_guard' => 'Warrant Officer Class 2',
                'air_guard_abbreviation' => 'WO2',
            ],
            [
                'name' => 'E8',
                'regiment' => 'Warrant Officer Class 1',
                'regiment_abbreviation' => 'WO1',
                'coast_guard' => 'Fleet Chief Petty Officer',
                'coast_guard_abbreviation' => 'FCPO',
                'air_guard' => 'Warrant Officer Class 1',
                'air_guard_abbreviation' => 'WO1',
            ],
            [
                'name' => 'O1',
                'regiment' => 'Officer Cadet',
                'regiment_abbreviation' => 'OCdt',
                'coast_guard' => 'Midshipman',
                'coast_guard_abbreviation' => 'Mid',
                'air_guard' => 'Officer Cadet',
                'air_guard_abbreviation' => 'OCdt',
            ],
            [
                'name' => 'O2',
                'regiment' => 'Second Lieutenant',
                'regiment_abbreviation' => '2 Lt',
                'coast_guard' => 'Acting Sub Lieutenant',
                'coast_guard_abbreviation' => 'Ag Sub Lt',
                'air_guard' => 'Pilot Officer',
                'air_guard_abbreviation' => 'Pl Off',
            ],
            [
                'name' => 'O3',
                'regiment' => 'Lieutenant',
                'regiment_abbreviation' => 'Lt',
                'coast_guard' => 'Sub Lieutenant',
                'coast_guard_abbreviation' => 'Sub Lt',
                'air_guard' => 'Flying Officer',
                'air_guard_abbreviation' => 'Fg Off',
            ],
            [
                'name' => 'O4',
                'regiment' => 'Captain',
                'regiment_abbreviation' => 'Capt',
                'coast_guard' => 'Lieutenant',
                'coast_guard_abbreviation' => 'Lt',
                'air_guard' => 'Flight Lieutenant',
                'air_guard_abbreviation' => 'Flt Lt',
            ],
            [
                'name' => 'O5',
                'regiment' => 'Major',
                'regiment_abbreviation' => 'Maj',
                'coast_guard' => 'Lieutenant Commander',
                'coast_guard_abbreviation' => 'Lt Cdr',
                'air_guard' => 'Squadron Leader',
                'air_guard_abbreviation' => 'Sqn Ldr',
            ],
            [
                'name' => 'O6',
                'regiment' => 'Lieutenant Colonel',
                'regiment_abbreviation' => 'Lt Col',
                'coast_guard' => 'Commander',
                'coast_guard_abbreviation' => 'Cdr',
                'air_guard' => 'Wing Commander',
                'air_guard_abbreviation' => 'Wg Commander',
            ],
            [
                'name' => 'O7',
                'regiment' => 'Colonel',
                'regiment_abbreviation' => 'Col',
                'coast_guard' => 'Captain',
                'coast_guard_abbreviation' => 'Capt',
                'air_guard' => 'Group Captain',
                'air_guard_abbreviation' => 'Gp Capt',
            ],
            [
                'name' => 'O8',
                'regiment' => 'Brigadier General',
                'regiment_abbreviation' => 'Brig Gen',
                'coast_guard' => 'Commodore',
                'coast_guard_abbreviation' => 'Cmdre',
                'air_guard' => 'Air Commodore',
                'air_guard_abbreviation' => 'Air Cmdre',
            ],
            [
                'name' => 'O9',
                'regiment' => 'Major General',
                'regiment_abbreviation' => 'Maj Gen',
                'coast_guard' => 'Rear Admiral',
                'coast_guard_abbreviation' => 'Radm',
                'air_guard' => 'Air Vice Marshall',
                'air_guard_abbreviation' => 'AVM',
            ],
        ];

        Rank::insert($ranks);
    }
}

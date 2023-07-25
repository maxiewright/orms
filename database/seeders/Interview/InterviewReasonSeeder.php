<?php

namespace Database\Seeders\Interview;

use App\Models\Metadata\InterviewReason;
use Illuminate\Database\Seeder;

class InterviewReasonSeeder extends Seeder
{
    public function run()
    {
        $reasons = [
            'performance',
            'welfare',
            'interdiction',
            'promotion',
            'seniority',
            'personal matter',
        ];

        foreach ($reasons as $reason) {
            InterviewReason::query()->create([
                'name' => $reason,
            ]);
        }
    }
}

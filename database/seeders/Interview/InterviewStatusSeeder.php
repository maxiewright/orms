<?php

namespace Database\Seeders\Interview;

use App\Models\Metadata\InterviewStatus;
use Illuminate\Database\Seeder;

class InterviewStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            'pending', 'cancelled', 'seen',
        ];

        foreach ($statuses as $status) {
            InterviewStatus::query()->create([
                'name' => $status,
            ]);
        }
    }
}

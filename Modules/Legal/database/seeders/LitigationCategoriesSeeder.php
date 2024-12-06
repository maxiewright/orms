<?php

namespace Modules\Legal\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Legal\Enums\LegalAction\LitigationCategoryType;
use Modules\Legal\Models\Ancillary\Litigation\LitigationCategory;

class LitigationCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Civil', 'Class Action', 'Employment', 'Intellectual Property', 'Administrative', 'Personal Injury'];

        $statuses = ['pending', 'active', 'settled', 'dismissed', 'judgment issued'];

        $reasons = [
            'Employment Discrimination',
            'Discrimination',
            'Sexual Harassment',
            'Personal Injury',
            'Breach of Contract',
            'Wrongful Termination'.
            'Unfair Dismissal',
            'Defamation',
            'Negligence',
            'Harassment',
            'Intellectual Property Infringement',
            'Infringement of Civil Rights',
        ];

        $outcomes = ['settled', 'judgment for plaintiff', 'judgment for defendant'];

        foreach ($types as $type) {
            LitigationCategory::create([
                'name' => $type,
                'type' => LitigationCategoryType::Type->value,
            ]);
        }

        foreach ($statuses as $status) {
            LitigationCategory::create([
                'name' => $status,
                'type' => LitigationCategoryType::Status->value,
            ]);
        }

        foreach ($reasons as $reason) {
            LitigationCategory::create([
                'name' => $reason,
                'type' => LitigationCategoryType::Reason->value,
            ]);
        }

        foreach ($outcomes as $outcome) {
            LitigationCategory::create([
                'name' => $outcome,
                'type' => LitigationCategoryType::Outcome->value,
            ]);
        }
    }
}

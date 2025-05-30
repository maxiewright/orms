<?php

namespace Modules\Registry\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Registry\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            // Document categories
            'Operational', 'Administrative', 'Logistics', 'Personnel', 'Finance', 'Legal',
            'Intelligence', 'Training', 'Medical', 'Security', 'Policy', 'Directive',

            // Priority indicators
            'Urgent', 'Routine', 'Priority', 'Immediate',

            // Departments/Units
            'Headquarters', 'Field Office', 'Command Center', 'Operations', 'Human Resources',
            'Supply Chain', 'Procurement', 'IT Department', 'Communications', 'Public Affairs',

            // Status related
            'Pending Response', 'Requires Action', 'For Information', 'Archived', 'Classified',

            // Document types
            'Report', 'Memo', 'Letter', 'Order', 'Directive', 'Request', 'Approval', 'Notification',
            'Briefing', 'Minutes', 'Proposal', 'Assessment', 'Review',

            // Special handling
            'Confidential', 'Restricted', 'Eyes Only', 'Time Sensitive', 'Draft', 'Final'
        ];

        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
                'description' => "Documents related to {$tagName} category or requiring {$tagName} handling."
            ]);
        }
    }
}

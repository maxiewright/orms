<?php

namespace Modules\Legal\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondenceType;

class LegalCorrespondenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $types = [
            'Pre Action Protocol Letter',
            'Request for Interdiction',
            'Notice of Interdiction',
        ];

        foreach ($types as $type) {
            LegalCorrespondenceType::create([
                'name' => $type,
            ]);
        }

        // $this->call([]);
    }
}

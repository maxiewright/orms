<?php

namespace Modules\Legal\Database\Seeders\Offences;

use Illuminate\Database\Seeder;
use Modules\Legal\Enums\Incident\OffenceType;
use Modules\Legal\Models\Ancillary\Infraction\OffenceDivision;

class SummaryOffenceDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $summaryOffenceDivisions = [
            'Assault And Battery',
            'Larceny, Embezzlement, False Pretences, And Malicious Injuries',
            'Receiving, Etc. Stolen Or Unlawfully Obtained Goods',
            'Entering Or Leaving Cultivated Lands',
            'Limitation',
            'Superstitious Devices',
            'Idle And Disorderly Persons',
            'Rogues And Vagabonds',
            'Incorrigible Rogues',
            'Violent Language and Breach of The Peace',
            'Indecency, Etc., In Certain Places',
            'Drunkenness Or Disorderly Conduct in Places of Public Resort',
            'Peace Preservation',
            'Offences In Streets and Other Public Places',
            'Flying Kites',
            'Fouling Of Rivers, Streams, and Ponds',
            'Inciting Dogs or Other Animals to Attack',
            'Keeping Swine',
            'Confinement Of Animals',
            'Cruelty To Animals',
            'Detention Of Animals for Treatment',
            'Destruction Of Animals',
            'Slaughtering Of Cattle',
            'Licensing Of Certain Trades',
            'Sunday Employment or Trading Generally',
            'Disturbing Places of Worship',
            'Navy Discipline',
            'Trinidad And Tobago Defence Force Uniforms',
            'Fireworks And Firearms',
            'Publications',
            'Telephones And Telegrams',
            'Public Meetings',
            'Public Marches and Processions',
            'Miscellaneous',
        ];

        foreach ($summaryOffenceDivisions as $summaryOffenceDivision) {
            OffenceDivision::query()
                ->create([
                    'type' => OffenceType::SummaryOffence,
                    'name' => $summaryOffenceDivision,
                ]);
        }
    }
}

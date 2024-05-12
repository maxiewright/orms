<?php

namespace Modules\Legal\Database\Seeders\Offences;

use Illuminate\Database\Seeder;
use Modules\Legal\Models\Ancillary\Infraction\OffenceSection;

class SummaryOffenceSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $summaryOffenceSections = [
            // Assault and Battery
            ['offence_division_id' => 1, 'section_number' => '4', 'name' => 'Assault and battery.'],
            ['offence_division_id' => 1, 'section_number' => '5', 'name' => 'Assault upon children, women and old, infirm, and sickly persons. Aggravated assaults causing wound or harm.'],
            ['offence_division_id' => 1, 'section_number' => '6', 'name' => 'Assaults by masked persons.'],
            ['offence_division_id' => 1, 'section_number' => '7', 'name' => 'Where assault unproved or trivial, certificate of dismissal to be bar to proceedings.'],
            ['offence_division_id' => 1, 'section_number' => '8', 'name' => 'Magistrate to abstain from adjudication in certain cases. Question of title, bankruptcy and execution.'],

            // Larceny, Embezzlement, False Pretences, and Malicious Injuries
            ['offence_division_id' => 2, 'section_number' => '9', 'name' => 'Larceny, embezzlement, false pretences.'],
            ['offence_division_id' => 2, 'section_number' => '10', 'name' => 'Larceny by a bailee.'],
            ['offence_division_id' => 2, 'section_number' => '11', 'name' => 'Larceny in dwelling house.'],
            ['offence_division_id' => 2, 'section_number' => '12', 'name' => 'Stealing sugar, rum, cocoa, etc.'],
            ['offence_division_id' => 2, 'section_number' => '13', 'name' => 'Stealing goods from vessels.'],
            ['offence_division_id' => 2, 'section_number' => '14', 'name' => 'Stealing animals.'],
            ['offence_division_id' => 2, 'section_number' => '14A', 'name' => 'Stealing livestock.'],
            ['offence_division_id' => 2, 'section_number' => '15', 'name' => 'Unlawful possession of animals or parts thereof.'],
            ['offence_division_id' => 2, 'section_number' => '16', 'name' => 'Killing and wounding animals.'],
            ['offence_division_id' => 2, 'section_number' => '17', 'name' => 'Killing and wounding pigeons.'],
            ['offence_division_id' => 2, 'section_number' => '19', 'name' => 'Stealing and damaging trees.'],
            ['offence_division_id' => 2, 'section_number' => '20', 'name' => 'Stealing and destroying fences.'],
            ['offence_division_id' => 2, 'section_number' => '21', 'name' => 'Stealing and destroying cultivated plants.'],
            ['offence_division_id' => 2, 'section_number' => '22', 'name' => 'Stealing, etc., sugar cane, cocoa, or other tree or vegetable productions, etc.'],
            ['offence_division_id' => 2, 'section_number' => '23', 'name' => 'Stealing agricultural produce.'],
            ['offence_division_id' => 2, 'section_number' => '24', 'name' => 'Fraudulent conversion.'],
            ['offence_division_id' => 2, 'section_number' => '25', 'name' => 'Damaging property not otherwise provided for.'],
            ['offence_division_id' => 2, 'section_number' => '26', 'name' => 'Injuring trees.'],
            ['offence_division_id' => 2, 'section_number' => '27', 'name' => 'Unlawful possession of trees or parts of fences.'],
            ['offence_division_id' => 2, 'section_number' => '28', 'name' => 'Unlawful possession of farm animal or parts thereof.'],
            ['offence_division_id' => 2, 'section_number' => '29', 'name' => 'Corporal punishment may be awarded for stealing, etc., farm animal or domestic animals.'],
            ['offence_division_id' => 2, 'section_number' => '30', 'name' => 'Second offence of stealing or damaging useful plants and domestic animals.'],
            ['offence_division_id' => 2, 'section_number' => '31', 'name' => 'Not necessary to prove malice.'],
            ['offence_division_id' => 2, 'section_number' => '32', 'name' => 'Compensation to injured person.'],
        ];

        foreach ($summaryOffenceSections as $summaryOffenceSection) {
            OffenceSection::query()->create($summaryOffenceSection);
        }
    }
}

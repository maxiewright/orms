<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class OperationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $operationsSubjects = [
            //81.	Exercises
            [
                'reference_number' => '8/1/1',
                'name' => 'Search and Rescue / National Helicopter',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/2',
                'name' => 'Training Exercises – Ops Evaluation Exercise TTR / March and Shoot',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/3',
                'name' => 'Us of Military Drug Interdiction / Eradication / Witness Protection Programme – New File 1994 / Weedeater Operations / Joint Combined Marijuana Eradication',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/4',
                'name' => 'Exercises with Foreign Forces',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/5',
                'name' => 'Exercises with Foreign Navies',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/6',
                'name' => 'Joint Operations – TTDF / TTPS',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/7',
                'name' => 'Exercise Tradewinds',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/8',
                'name' => 'Incidents at Sea',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/9',
                'name' => 'Caribbean Support Tenders',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/10',
                'name' => 'Special Naval Unit / SF / SOG',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/11',
                'name' => 'Cobalt Mercury (New File opened 31 July 2000)',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/12',
                'name' => 'Operations Orders',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/13',
                'name' => 'Operation Status – Coast Guard / TTR / AG',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/14',
                'name' => 'Exercise Ocean Venture',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/15',
                'name' => 'Exercise Cinnamon Post – 1992 New File 1994',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/16',
                'name' => 'US Army Engineer Readiness Training Exercise (ENTRE) with U&E',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/17',
                'name' => 'Exercise Safe Guard',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/18',
                'name' => 'Ops 18 Not Used',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/19',
                'name' => 'Operation Haiti',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/20',
                'name' => 'United Nations Mission in Haiti (UNMIH) (Closed 31 July 2000)',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/21',
                'name' => 'Operation St Kitts / CARICOM Village',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/22',
                'name' => 'Operation Antigua / Barbuda',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/23',
                'name' => 'Operation Debrief / Brief',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/24',
                'name' => 'Construction of Fence – Jammaat Al Muslimeen',
                'index_sub_group_id' => 81,
            ],
            [
                'reference_number' => '8/1/25',
                'name' => '“Vincy Pac”',
                'index_sub_group_id' => 81,
            ],

            //82. Patrols

            [
                'reference_number' => '8/2/1',
                'name' => 'Ops 21 Not Used',
                'index_sub_group_id' => 82,
            ],
            [
                'reference_number' => '8/2/2',
                'name' => 'Ops 22 Not Used',
                'index_sub_group_id' => 82,
            ],
            [
                'reference_number' => '8/2/3',
                'name' => 'Town Patrol',
                'index_sub_group_id' => 82,
            ],
            [
                'reference_number' => '8/2/4',
                'name' => 'Joint Patrols with the Police',
                'index_sub_group_id' => 82,
            ],
            [
                'reference_number' => '8/2/5',
                'name' => 'Pipeline Patrols',
                'index_sub_group_id' => 82,
            ],
            [
                'reference_number' => '8/2/6',
                'name' => 'Joint Patrol – TTCG / Venezuela National Guard',
                'index_sub_group_id' => 82,
            ],
            [
                'reference_number' => '8/2/7',
                'name' => 'Vessel Status – TTCG / Vessel Status Air Craft',
                'index_sub_group_id' => 82,
            ],
            [
                'reference_number' => '8/2/8',
                'name' => 'Donation by US Government',
                'index_sub_group_id' => 82,
            ],
            [
                'reference_number' => '8/2/9',
                'name' => 'Recce Patrols / CG Vessels Patrols / Recce Patrols / Ag Patrols',
                'index_sub_group_id' => 82,
            ],
            [
                'reference_number' => '8/2/10',
                'name' => 'Deployment of DF in Aid to Civil Power',
                'index_sub_group_id' => 82,
            ],

        ];

        foreach ($operationsSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}

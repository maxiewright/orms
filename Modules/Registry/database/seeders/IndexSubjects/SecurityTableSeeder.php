<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SecurityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $securitySubjects = [
            //141. Gov't Building
            [
                'reference_number' => '14/1/1',
                'name' => 'Government Building and Premises',
                'index_sub_group_id' => 141,
            ],
            [
                'reference_number' => '14/1/2',
                'name' => 'Control of Air Space',
                'index_sub_group_id' => 141,
            ],
            [
                'reference_number' => '14/1/3',
                'name' => 'Intelligence Office Operations (Int & Sy)',
                'index_sub_group_id' => 141,
            ],
            [
                'reference_number' => '14/1/4',
                'name' => 'Security Passes and Honorary Membership',
                'index_sub_group_id' => 141,
            ],
            [
                'reference_number' => '14/1/5',
                'name' => 'Camp and Station Pass',
                'index_sub_group_id' => 141,
            ],
            [
                'reference_number' => '14/1/6',
                'name' => 'Airport Authority Pass/Security',
                'index_sub_group_id' => 141,
            ],
            [
                'reference_number' => '14/1/7',
                'name' => 'Contact with Foreign Officials Embassies',
                'index_sub_group_id' => 141,
            ],
            [
                'reference_number' => '14/1/8',
                'name' => 'National Security Policy',
                'index_sub_group_id' => 141,
            ],
            [
                'reference_number' => '14/1/9',
                'name' => 'Port Facilities',
                'index_sub_group_id' => 141,
            ],

            //142. Jamaat Al Muslimeen - CLOSED

            //143. Guards

            [
                'reference_number' => '14/3/1',
                'name' => 'President Guard',
                'index_sub_group_id' => 143,
            ],
            [
                'reference_number' => '14/3/2',
                'name' => 'Prime Minister Guard',
                'index_sub_group_id' => 143,
            ],

            [
                'reference_number' => '14/3/3',
                'name' => 'CDS Guard / CO TTR / MNS',
                'index_sub_group_id' => 143,
            ],

            [
                'reference_number' => '14/3/4',
                'name' => 'War Dogs',
                'index_sub_group_id' => 143,
            ],

            [
                'reference_number' => '14/3/5',
                'name' => 'Orders',
                'index_sub_group_id' => 143,
            ],

            [
                'reference_number' => '14/3/6',
                'name' => 'Prison Duties/Guards',
                'index_sub_group_id' => 143,
            ],

            //144. Caribbean Security

            [
                'reference_number' => '14/4/1',
                'name' => 'Caribbean Security (Regional Security System)',
                'index_sub_group_id' => 144,
            ],
            [
                'reference_number' => '14/4/2',
                'name' => 'Caribbean Nations Security Conference (CANSEC)',
                'index_sub_group_id' => 144,
            ],

        ];

        foreach ($securitySubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}

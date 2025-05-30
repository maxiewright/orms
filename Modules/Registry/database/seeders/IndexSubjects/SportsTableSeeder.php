<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $sportsSubjects = [
            // 131. Local/Regional/International
            [
                'reference_number' => '13/1/1',
                'name' => 'Sports Policy / Defence Force Sports',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/2',
                'name' => 'Athletics / Triathlon',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/3',
                'name' => 'Badminton',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/4',
                'name' => 'Boxing',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/5',
                'name' => 'Cricket',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/6',
                'name' => 'Defence Force Sports Academy',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/7',
                'name' => 'Football',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/8',
                'name' => 'Olympic / Special Olympics',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/9',
                'name' => 'Gymnastics / Karate',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/10',
                'name' => 'Hockey',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/11',
                'name' => 'Netball	',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/12',
                'name' => 'TTR / TTCG Sports',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/13',
                'name' => 'Power Boat Racing / Yachting',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/14',
                'name' => 'Rugby',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/15',
                'name' => 'Shooting / Trap & Skeet / Trinidad Rifle Association',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/16',
                'name' => 'Swimming / Aquatics',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/17',
                'name' => 'Table Tennis / Lawn Tennis',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/18',
                'name' => 'Volleyball',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/19',
                'name' => 'Cycling',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/20',
                'name' => 'Basketball',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/21',
                'name' => 'Weight Training / Body Building',
                'index_sub_group_id' => 131,
            ],
            [
                'reference_number' => '13/1/22',
                'name' => 'Ministry of National Security Sports',
                'index_sub_group_id' => 131,
            ],
        ];

        foreach ($sportsSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}

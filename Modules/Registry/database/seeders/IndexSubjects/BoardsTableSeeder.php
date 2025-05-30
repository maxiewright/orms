<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $boardsSubjects = [
            //31.	Board of Inquiry TTR
            [
                'reference_number' => '3/1/1',
                'name' => 'Board of Inquiry (Policy)',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/2',
                'name' => '8231 Pte Jones S of C Coy – AWOL',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/3',
                'name' => 'Destruction of Camp Omega',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/4',
                'name' => 'Loss of 9mm Browning Pistol SN 245 py 98711 at Camp Cumuto A Coy on 14 June 1990',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/5',
                'name' => 'Shooting Incident involving LCpl Romeo',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/6',
                'name' => 'Shooting Incident involving Pte Boiselle J',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/7',
                'name' => 'Shooting Incident involving LCpl Haynes at Chag Market',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/8',
                'name' => 'Explosion at B Coy Stores – 8123 Pte Glasgow',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/9',
                'name' => 'Loss of SLR SN AD 6417396 at DFHQ (VDF) - Pte Gajadhar',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/10',
                'name' => 'Loss of 39 Galil Magazines',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/11',
                'name' => 'Loss of Grenade L2 HE',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/12',
                'name' => 'Inquest into Death of Civilian John Ottley on 25 July 1994',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/13',
                'name' => 'Missing .38 Revolver',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/14',
                'name' => 'Loss of Pistol SN 75C66598 by 2Lt S Subero',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/15',
                'name' => 'Missing 6mm / .35 Baby Browning Pistol',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/16',
                'name' => 'Stolen Revolver CTC',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/17',
                'name' => 'Shooting of 8951 Pte Smart M',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/18',
                'name' => 'L2 A2 Anti-Personnel Grenade',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/19',
                'name' => 'Death of 4495 Pte Wight D',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/20',
                'name' => '20.	Board of Inquiry – Injuries to Soldiers during Tropical Storm Bret on 8 August 1993',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/21',
                'name' => 'Board of Inquiry – Death of 8129 Pte Cordner J',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/22',
                'name' => 'Regimental Inquiry – Missing Plywood Sheets',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/23',
                'name' => 'Board of Inquiry – Missing Chain Saw (CCC)',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/24',
                'name' => 'Board of Inquiry – Mr Barnes (FCPO Office)',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/25',
                'name' => 'Board of Inquiry – Death of 8938 Pte Dewen G',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/26',
                'name' => 'Death of 4706 Pte Greenidge C',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/27',
                'name' => 'Death of Witness Clint Huggins',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/28',
                'name' => 'Death of Pte Richards C',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/29',
                'name' => 'Board of Inquiry – Shooting of 8236 Pte Lougheed G',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/30',
                'name' => 'Missing Galil Magazine (2TTR)',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/31',
                'name' => 'Loss of Service Weapon (PO Cadiz)',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/32',
                'name' => 'CCC Vehicle TBA 3884',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/33',
                'name' => 'Wearing of T&T’s Issue Army Uniform by Civilians',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/34',
                'name' => 'Board of Inquiry into the Missing Radio Motorola Portable MTX 838',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/35',
                'name' => 'Board of Inquiry into the Circumstances which led to the Discharge of A Weapon at CCC Hq Beetham Estate POS on 8 June 1996',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/36',
                'name' => 'Shooting Incident 9568 Rec Lara N',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/37',
                'name' => 'Board of Inquiry – Service Vehicle 3TTR90',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/38',
                'name' => 'Board of Inquiry – Incident involving Mr Flemming',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/39',
                'name' => 'Death of Commander Penco',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/40',
                'name' => 'Board of Inquiry – Missing Sig Sauer – Mech Mitchell S',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/41',
                'name' => 'Board of Inquiry – Incident involving Lt Mohammed-Affonso',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/42',
                'name' => 'Board of Inquiry – Incident involving Lt D Barnes',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/43',
                'name' => 'Board of Inquiry - 9150 Pte Ward D',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/44',
                'name' => 'Board of Inquiry – Accident involving vehicle 3TTR102',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/45',
                'name' => 'Board of Inquiry – 9210 Rec Arneaud H',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/46',
                'name' => 'Board of Inquiry – 9038 Pte Alfonso C',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/47',
                'name' => 'Board of Inquiry – 0118 Lt NA Pantin',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/48',
                'name' => 'Board of Inquiry – 9377 Pte Young A',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/49',
                'name' => 'Board of Inquiry – 8793 Pte Moore I',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/50',
                'name' => 'Board of Inquiry – Capt GT Griffith',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/68',
                'name' => 'Board of Inquiry – Inquires during Weedeater 02',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/69',
                'name' => 'Board of Inquiry – Alleged beating by soldiers',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/92',
                'name' => 'Board of Inquiry – Circumstances which led to 11478 Ex Rec(F) Browne
                    Trg Coy sustaining injuries to her back on Friday 26 Dec 05	Board of Inquiry – Investigation into the circumstances surrounding',
                'index_sub_group_id' => 31,
            ],
            [
                'reference_number' => '3/1/93',
                'name' => 'Board of Inquiry – Investigation into the circumstances surrounding
                    The incident whereby Sgt Williams shot Mr R Smith on Wed 21 Feb 07 ',
                'index_sub_group_id' => 31,
            ],

            //32.   Board of Inquiry CG

            [
                'reference_number' => '3/2/1',
                'name' => 'Board of Inquiry – Policy',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/2/2',
                'name' => 'Breaking in of #3 and #4 Bunker at Pt Gourde',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/2/3',
                'name' => 'Loss of 9mm Browning on Board TTS Cascadura',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/2/4',
                'name' => 'Loss of TTS Matura',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/2/5',
                'name' => 'Accident Involving 4CG12 and Death of CPO Parasram on 10 Nov 91',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/2/6',
                'name' => 'Loss of one (1) Midland Land loss Radio #024375 from on Board TTS Carenage',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/2/7',
                'name' => 'Shooting Incident on Audrey Jeffers on 30 April 1993',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/2/8',
                'name' => 'Treatment of Crew on Pirogue',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/29/',
                'name' => 'Board of Inquiry CG Vessel TTS Cascadura (CG6)',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/2/10',
                'name' => 'Damage of TTS Roxborough (CG39) on 30 June 1995',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/2/11',
                'name' => 'Report on lone Fly Pass of CG 203',
                'index_sub_group_id' => 32,
            ],
            [
                'reference_number' => '3/2/12',
                'name' => 'Damage of CG 202',
                'index_sub_group_id' => 32,
            ],

            //33.   Commissions Board

            [
                'reference_number' => '3/3/1',
                'name' => 'Membership and Regulations',
                'index_sub_group_id' => 33,
            ],
            [
                'reference_number' => '3/3/2',
                'name' => 'Invitation to Meeting',
                'index_sub_group_id' => 33,
            ],
            [
                'reference_number' => '3/3/3',
                'name' => 'Minutes to Meeting',
                'index_sub_group_id' => 33,
            ],
            [
                'reference_number' => '3/3/4',
                'name' => 'Matters Arising from Minutes',
                'index_sub_group_id' => 33,
            ],
            [
                'reference_number' => '3/3/5',
                'name' => 'Application for Commission by Serving Members',
                'index_sub_group_id' => 33,
            ],
            [
                'reference_number' => '3/3/6',
                'name' => 'Application for Commission by Civilians',
                'index_sub_group_id' => 33,
            ],
            [
                'reference_number' => '3/3/7',
                'name' => 'Recommendation to Ministry – Commission',
                'index_sub_group_id' => 33,
            ],
            [
                'reference_number' => '3/3/8',
                'name' => 'Recommendation to Ministry – Promotions',
                'index_sub_group_id' => 33,
            ],
            [
                'reference_number' => '3/3/9',
                'name' => 'Short Service Commission Officers',
                'index_sub_group_id' => 33,
            ],
            [
                'reference_number' => '3/3/10',
                'name' => 'Honorary Commission',
                'index_sub_group_id' => 33,
            ],
            [
                'reference_number' => '3/3/11',
                'name' => 'Official Correspondence Address to Secretary',
                'index_sub_group_id' => 33,
            ],

            //34.   Boards of Survey

            [
                'reference_number' => '3/4/1',
                'name' => 'Board of Survey (Policy) TTR',
                'index_sub_group_id' => 34,
            ],
            [
                'reference_number' => '3/4/2',
                'name' => 'Disposal of Voting Machines',
                'index_sub_group_id' => 34,
            ],
            [
                'reference_number' => '3/4/3',
                'name' => 'Board of Survey CG',
                'index_sub_group_id' => 34,
            ],
        ];

        foreach ($boardsSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}

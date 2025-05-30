<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class AdministrationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $administrationSubjects = [
            //21. 	Accident
            [
                'reference_number' => '2/1/1',
                'name' => 'Accidents TTR Vehicles',
                'index_sub_group_id' => 21,
            ],
            [
                'reference_number' => '2/1/2',
                'name' => 'Accidents TTCG Vehicles',
                'index_sub_group_id' => 21,
            ],
            [
                'reference_number' => '2/1/3',
                'name' => 'Accidents TTAG Vehicles',
                'index_sub_group_id' => 21,
            ],

            [
                'reference_number' => '2/1/4',
                'name' => 'Accidents TTDF Vehicles',
                'index_sub_group_id' => 21,
            ],
            [
                'reference_number' => '2/1/5',
                'name' => 'Accidents TTDFR Vehicles',
                'index_sub_group_id' => 21,
            ],

            //                22.Chaplain
            [
                'reference_number' => '2/2/1',
                'name' => 'Chaplain of the Defence Force',
                'index_sub_group_id' => 21,
            ],
            //                23.Arms / Ammunition
            [
                'reference_number' => '2/3/1',
                'name' => 'Arms and Ammunition / Explosives',
                'index_sub_group_id' => 23,
            ],
            [
                'reference_number' => '2/3/2',
                'name' => 'Bomb Disposal',
                'index_sub_group_id' => 23,
            ],
            [
                'reference_number' => '2/3/3',
                'name' => 'Powder Magazine / Bunkers',
                'index_sub_group_id' => 23,
            ],
            [
                'reference_number' => '2/3/4',
                'name' => 'Torpedo found in Moruga',
                'index_sub_group_id' => 23,
            ],
            [
                'reference_number' => '2/3/5',
                'name' => 'Firearm User License / Permit',
                'index_sub_group_id' => 23,
            ],
            [
                'reference_number' => '2/3/6',
                'name' => 'Tucker Valley / La Sieva Range',
                'index_sub_group_id' => 23,
            ],
            [
                'reference_number' => '2/3/7',
                'name' => 'Request for Ammo',
                'index_sub_group_id' => 23,
            ],
            [
                'reference_number' => '2/3/8',
                'name' => 'Arms/Ammo Appendix',
                'index_sub_group_id' => 23,
            ],
            [
                'reference_number' => '2/3/9',
                'name' => 'Ammo State',
                'index_sub_group_id' => 23,
            ],
            [
                'reference_number' => '2/3/10',
                'name' => 'Arms & Ammo Safe Custody',
                'index_sub_group_id' => 23,
            ],
            [
                'reference_number' => '2/3/11',
                'name' => 'Ammo User Inspection Report/ Defects',
                'index_sub_group_id' => 23,
            ],

            //                24.Assistance Civilians / Organisations
            [
                'reference_number' => '2/4/1',
                'name' => 'Cadet Force / Cadet Force Advisory Committee',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/2',
                'name' => 'Red Cross / St Johns Ambulance Brigade',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/3',
                'name' => 'Boys Scout',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/4',
                'name' => 'Girls Guide',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/5',
                'name' => 'T & T Legion / Salvation Army',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/6',
                'name' => 'Road Safety Association',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/7',
                'name' => 'All Other Group / Organizations',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/8',
                'name' => 'Carnival Celebrations / Security',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/9',
                'name' => 'Servol',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/10',
                'name' => 'Request for Hall of Resid / Chag Play Field ',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/11',
                'name' => 'Defence Force Community Caravan',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/12',
                'name' => 'Assitance by Utility & Engineering Battalion',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/13',
                'name' => 'Blind / Deaf Welfare Association',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/14',
                'name' => 'Assitance to Ministry & Government Departments',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/15',
                'name' => 'Request for Regiment Band / Steel Band',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/16',
                'name' => 'Youth Camp / MYLAT - MYPART / Army Youth Group',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/17',
                'name' => 'Request for Tents and Other Matters',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/18',
                'name' => 'Request for Transport',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/19',
                'name' => 'Ex-Sevicemen Association',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/20',
                'name' => 'Career Guidance / Info on Defence Forcer / Displays',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/21',
                'name' => 'Assitance to Military Organizations (with training, hosuing etc)',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/22',
                'name' => 'Request for info on Military Clothing / Equipment / Personnel',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/23',
                'name' => 'Assistance to Rehabilitation Centers',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/24',
                'name' => 'Civilian Conservation Corps / Reintroduction of CC opened from 2002 / Hand Over / Take Over Document',
                'index_sub_group_id' => 24,
            ],
            [
                'reference_number' => '2/4/25',
                'name' => 'President Award Scheme',
                'index_sub_group_id' => 24,
            ],

            //                25.Crsis / Disasters
            [
                'reference_number' => '2/5/1',
                'name' => 'National Emergency Relief Org NERO / NEMA / CDERA & OFDA',
                'index_sub_group_id' => 25,
            ],
            [
                'reference_number' => '2/5/2',
                'name' => 'Flood Relief / Natural Disasters',
                'index_sub_group_id' => 25,
            ],
            [
                'reference_number' => '2/5/3',
                'name' => 'Hurricane',
                'index_sub_group_id' => 25,
            ],
            [
                'reference_number' => '2/5/4',
                'name' => 'Volcano Eruptions',
                'index_sub_group_id' => 25,
            ],
            [
                'reference_number' => '2/5/5',
                'name' => 'Industrial Crisis',
                'index_sub_group_id' => 25,
            ],
            [
                'reference_number' => '2/5/6',
                'name' => 'Disaster Preparedness/ODPM',
                'index_sub_group_id' => 25,
            ],
            [
                'reference_number' => '2/5/7',
                'name' => 'CARICOM Disaster Relief / ANTIGUA Disaster Relief',
                'index_sub_group_id' => 25,
            ],
            [
                'reference_number' => '2/5/8',
                'name' => 'Committee of the International Decade of Natural Disasters',
                'index_sub_group_id' => 25,
            ],
            [
                'reference_number' => '2/5/9',
                'name' => 'Airport Emergency Plan',
                'index_sub_group_id' => 25,
            ],

            //                26.Communication
            [
                'reference_number' => '2/6/1',
                'name' => 'Telephone / Wireless / Internet / Development of Local Area Network for DFHQ',
                'index_sub_group_id' => 26,
            ],
            [
                'reference_number' => '2/6/2',
                'name' => 'Telgram / Fax / Fax Numbers / Change of Address',
                'index_sub_group_id' => 26,
            ],
            [
                'reference_number' => '2/6/3',
                'name' => 'Intra Ministerial Network - Morne Diablo',
                'index_sub_group_id' => 26,
            ],
            [
                'reference_number' => '2/6/4',
                'name' => 'Threatening Phone Calls - Death Threats',
                'index_sub_group_id' => 26,
            ],
            //                27.Elections
            [
                'reference_number' => '2/7/1',
                'name' => 'General Elections',
                'index_sub_group_id' => 27,
            ],
            [
                'reference_number' => '2/7/2',
                'name' => 'Local Government Elections',
                'index_sub_group_id' => 27,
            ],
            //                28.Equipment / Stationary
            [
                'reference_number' => '2/8/1',
                'name' => 'Office Stationery',
                'index_sub_group_id' => 28,
            ],
            [
                'reference_number' => '2/8/2',
                'name' => 'Office Equipment',
                'index_sub_group_id' => 28,
            ],
            [
                'reference_number' => '2/8/3',
                'name' => 'Computers',
                'index_sub_group_id' => 28,
            ],
            [
                'reference_number' => '2/8/4',
                'name' => 'Mail Despatch',
                'index_sub_group_id' => 28,
            ],
            //                29.Survey
            [
                'reference_number' => '2/9/1',
                'name' => 'Coastal / Surveillance of T & T Waters',
                'index_sub_group_id' => 29,
            ],
            [
                'reference_number' => '2/92',
                'name' => 'Environment Pollution',
                'index_sub_group_id' => 29,
            ],
            [
                'reference_number' => '2/9/3',
                'name' => 'Intl Maritime Organization / Institution of Maritime Affairs',
                'index_sub_group_id' => 29,
            ],
            [
                'reference_number' => '2/9/4',
                'name' => 'Ocean "98"',
                'index_sub_group_id' => 29,
            ],
            [
                'reference_number' => '2/9/5',
                'name' => 'Defence Force & Protective Service Employee Survey',
                'index_sub_group_id' => 29,
            ],
            //                210.Inspection
            [
                'reference_number' => '2/10/1',
                'name' => 'Camps and Stations',
                'index_sub_group_id' => 210,
            ],
            [
                'reference_number' => '2/10/2',
                'name' => 'Government Quarters and Hiring',
                'index_sub_group_id' => 210,
            ],                [
                'reference_number' => '2/10/3',
                'name' => 'Admin Inspections',
                'index_sub_group_id' => 210,
            ],                [
                'reference_number' => '2/10/4',
                'name' => 'Admin Inspection Returns',
                'index_sub_group_id' => 210,
            ],
            //                211.Invitations
            [
                'reference_number' => '2/11/1',
                'name' => 'To Military Functions',
                'index_sub_group_id' => 211,
            ],
            [
                'reference_number' => '2/11/2',
                'name' => 'From Civilian Org / Military History',
                'index_sub_group_id' => 211,
            ],
            [
                'reference_number' => '2/11/3',
                'name' => 'Invitation List',
                'index_sub_group_id' => 211,
            ],
            //                212.Models / Awards / Flags
            [
                'reference_number' => '2/12/1',
                'name' => 'Long Service Award',
                'index_sub_group_id' => 212,
            ],
            [
                'reference_number' => '2/12/2',
                'name' => 'National Award',
                'index_sub_group_id' => 212,
            ],
            [
                'reference_number' => '2/12/3',
                'name' => 'Long Service Award Certificates (New File)',
                'index_sub_group_id' => 212,
            ],
            [
                'reference_number' => '2/12/4',
                'name' => 'Medals / Award Forces Records',
                'index_sub_group_id' => 212,
            ],
            [
                'reference_number' => '2/12/5',
                'name' => 'Flags / Colours',
                'index_sub_group_id' => 212,
            ],
            [
                'reference_number' => '2/12/6',
                'name' => 'South Caribbean Forces Records',
                'index_sub_group_id' => 212,
            ],
            [
                'reference_number' => '2/12/7',
                'name' => 'Commissioning Parchments / Issue of Parchments to Warrant Officers',
                'index_sub_group_id' => 212,
            ],
            [
                'reference_number' => '2/12/8',
                'name' => 'Defence Force Medals Awards',
                'index_sub_group_id' => 212,
            ],
            //                213.Orders / Interviews
            [
                'reference_number' => '2/13/1',
                'name' => 'MNS / Defence Council / Prime Minister / President',
                'index_sub_group_id' => 213,
            ],
            [
                'reference_number' => '2/13/2',
                'name' => 'Chief of Defence Staff',
                'index_sub_group_id' => 213,
            ],
            [
                'reference_number' => '2/13/3',
                'name' => 'Commanding Officers',
                'index_sub_group_id' => 213,
            ],
            [
                'reference_number' => '2/13/4',
                'name' => 'Detachment Commanders',
                'index_sub_group_id' => 213,
            ],
            [
                'reference_number' => '2/13/5',
                'name' => 'Interview with Media Personnel / Interview',
                'index_sub_group_id' => 213,
            ],
            [
                'reference_number' => '2/13/6',
                'name' => 'Application for REdress of Complaint to Defence Council',
                'index_sub_group_id' => 213,
            ],
            //                214.Policy / Regulations
            [
                'reference_number' => '2/14/1',
                'name' => 'Defence Act / Law Regulations',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/2',
                'name' => 'Economic Exclusion Zone',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/4',
                'name' => 'T & T / Venezuala Fishing Agreement / Operations Ventri',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/5',
                'name' => 'T & T / Barbados Fishing Agreement',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/6',
                'name' => 'Compensation / Personnel Injured / Died on Duty',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/7',
                'name' => 'Burial at Sea',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/8',
                'name' => 'T & T / Venezuela Oil Spill Agreement',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/9',
                'name' => 'Illegal Fishing in T & T Waters',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/10',
                'name' => 'T & T / Venezuela Mixed Commissioning on Drugs',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/11',
                'name' => 'Geneva Conventions - Initl Convention on (SOLAS)',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/12',
                'name' => 'Flag State / Ship Riders Status on Forces Agreement',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/13',
                'name' => 'Draft Agreement between the Republic of Cuba and Republic of T & T',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/14',
                'name' => 'Visiting Forces Legislation in the Repubic of T & T',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/15',
                'name' => 'Trinidad and Tobago / Venezuela Bi-National Frontier Comission',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/16',
                'name' => 'Fishing Agreement between Triniad and Tobago and Guyana',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/17',
                'name' => 'Draft Legislation between T & T and UK',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/18',
                'name' => 'Maritime Boundary Delimitation Treaty Between Trinidad and Tobago',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/19',
                'name' => 'Policies – CDS (new file 2003)',
                'index_sub_group_id' => 214,
            ],
            [
                'reference_number' => '2/14/20',
                'name' => 'Policy on HIV / AIDS',
                'index_sub_group_id' => 214,
            ],
            //                215.Visits
            [
                'reference_number' => '2/15/1',
                'name' => 'Visits of Foreign Ships',
                'index_sub_group_id' => 215,
            ],
            [
                'reference_number' => '2/15/2',
                'name' => 'Requests to Visit Military Areas/ T / Bks',
                'index_sub_group_id' => 215,
            ],
            [
                'reference_number' => '2/15/3',
                'name' => 'Visits of Foreign Officials / Military Personnel',
                'index_sub_group_id' => 215,
            ],
            [
                'reference_number' => '2/15/4',
                'name' => 'Exchange of Visits',
                'index_sub_group_id' => 215,
            ],
            [
                'reference_number' => '2/15/5',
                'name' => 'Visit to Foreign Countries / Guide for Clearance to Foreign Country',
                'index_sub_group_id' => 215,
            ],
            [
                'reference_number' => '2/15/6',
                'name' => 'Visits of Foreign Aircraft',
                'index_sub_group_id' => 215,
            ],
            [
                'reference_number' => '2/15/7',
                'name' => 'Ops Visits by CG Vessels / Aircrafts',
                'index_sub_group_id' => 215,
            ],
            [
                'reference_number' => '2/15/8',
                'name' => 'Personnel visiting DFHQ on Business and Other Matters',
                'index_sub_group_id' => 215,
            ],
            [
                'reference_number' => '2/15/9',
                'name' => 'Visits to Tobago',
                'index_sub_group_id' => 215,
            ],

            //                216.Command
            [
                'reference_number' => '2/16/1',
                'name' => 'T&T Defence Force – Restructuring DF / Presentation of Trinidad and Tobago / Cabinet Notes (new file)',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/2',
                'name' => 'T&T Regiment',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/3',
                'name' => 'T & T Coast Guard / T & T Air Guard',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/4',
                'name' => 'Company / Detachment / Military Police',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/5',
                'name' => 'Hand Over / Take Over Certificates – CDS / CO’s / Hand Over / Take Over Certificates – OC / HOD',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/6',
                'name' => 'Establishment of the DF as a Unit',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/7',
                'name' => 'Affiliation of TTR to British Force as a Unit',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/8',
                'name' => 'Establishment of a Welfare Unit / Relocation',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/9',
                'name' => 'Duties – Staff Officer / Snr NCO’s / ORs',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/10',
                'name' => 'Field Officers / Captain of the Week (DFHQ) / Orderly Officer',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/11',
                'name' => 'Establishment Engineering Unit',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/12',
                'name' => 'Establishment of the Human Resource Department',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/13',
                'name' => 'Establishment of an Environmental Post',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/14',
                'name' => 'Admin Re-organisation of Caribbean Fisheries Training & Development',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/15',
                'name' => 'Establishment RHQ',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/16',
                'name' => 'Establishment Sports Company',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/17',
                'name' => 'Establishment of Defence Force Steel Orchestra',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/18',
                'name' => 'Director of Projects / Logistics',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/19',
                'name' => 'Establishment of a Military Mortuary',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/20',
                'name' => 'Establishment of a new Research Unit',
                'index_sub_group_id' => 216,
            ],
            [
                'reference_number' => '2/16/21',
                'name' => 'Establishment of the OCC Building',
                'index_sub_group_id' => 216,
            ],

            //                217.Government Institutions
            [
                'reference_number' => '2/17/1',
                'name' => 'Customs and Excise',
                'index_sub_group_id' => 217,
            ],
            [
                'reference_number' => '2/17/2',
                'name' => 'Immigration',
                'index_sub_group_id' => 217,
            ],
            [
                'reference_number' => '2/17/3',
                'name' => 'Organisations',
                'index_sub_group_id' => 217,
            ],
            [
                'reference_number' => '2/17/4',
                'name' => 'Public Service Reform',
                'index_sub_group_id' => 217,
            ],
            [
                'reference_number' => '2/17/5',
                'name' => 'Military Museum / Ex Servicemen / History of TTDF',
                'index_sub_group_id' => 217,
            ],
            [
                'reference_number' => '2/17/6',
                'name' => 'Strategic Service Agency (SSA (New File) / SIA',
                'index_sub_group_id' => 217,
            ],
            //                218.Publication / Circular Memorandum
            [
                'reference_number' => '2/18/1',
                'name' => 'News Letters / Publications / Emails',
                'index_sub_group_id' => 218,
            ],
            [
                'reference_number' => '2/18/2',
                'name' => 'Circular Memorandum',
                'index_sub_group_id' => 218,
            ],
            [
                'reference_number' => '2/18/3',
                'name' => 'Press Release / Newspapers',
                'index_sub_group_id' => 218,
            ],
            [
                'reference_number' => '2/18/4',
                'name' => 'Regiment / Coast Guard Magazine / Defence Force Magazine	/ Calendar',
                'index_sub_group_id' => 218,
            ],
            [
                'reference_number' => '2/18/5',
                'name' => 'Subversive Literature',
                'index_sub_group_id' => 218,
            ],
            [
                'reference_number' => '2/18/6',
                'name' => 'Defence Force Library (New File)',
                'index_sub_group_id' => 218,
            ],
            //                219.Vehicles / Military ID / Military Drivers Permit
            [
                'reference_number' => '2/19/1',
                'name' => 'Vehicle State',
                'index_sub_group_id' => 219,
            ],
            [
                'reference_number' => '2/19/2',
                'name' => 'Vehicle Repairs / Rental',
                'index_sub_group_id' => 219,
            ],
            [
                'reference_number' => '2/19/3',
                'name' => 'Priority Bus Route Pass',
                'index_sub_group_id' => 219,
            ],
            [
                'reference_number' => '2/19/4',
                'name' => 'Military Driving Permits / Military ID Cards',
                'index_sub_group_id' => 219,
            ],
            [
                'reference_number' => '2/19/5',
                'name' => 'Licensing of Official Vehicles',
                'index_sub_group_id' => 219,
            ],
            //                220.Agriculture
            [
                'reference_number' => '2/20/1',
                'name' => 'Defence Force Agriculture Project',
                'index_sub_group_id' => 220,
            ],
            //                221.Private Companies
            [
                'reference_number' => '2/21/1',
                'name' => 'Companies willing to do Business with TTDF',
                'index_sub_group_id' => 220,
            ],
            [
                'reference_number' => '2/21/2',
                'name' => 'Financial Concepts Limited',
                'index_sub_group_id' => 220,
            ],
        ];

        foreach ($administrationSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}

<?php

namespace Modules\Registry\Database\Seeders\IndexSubjects;

use Modules\Registry\Models\RegistryIndex\IndexSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class FinancialAndAccountingMattersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $financialAndAccountingMattersSubjects = [
            //71.	Estimates
            [
                'reference_number' => '7/1/1',
                'name' => 'Estimates 1990',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/2',
                'name' => 'Estimates 1991',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/3',
                'name' => 'Estimates 1992',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/4',
                'name' => 'Draft Estimates 1993',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/5',
                'name' => 'Draft Estimates 1994',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/6',
                'name' => 'Budget 1994',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/7',
                'name' => 'Draft Estimates 1995',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/8',
                'name' => 'Development Programme',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/9',
                'name' => 'Draft Estimates 1999',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/10',
                'name' => 'Programme / Projects 2000 – (TTR & TTCG)',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/11',
                'name' => 'Draft Estimate 2001 / Budget, Medium Term Policy Framework',
                'index_sub_group_id' => 71,
            ],
            [
                'reference_number' => '7/1/12',
                'name' => 'Draft Estimate 2008 and beyond',
                'index_sub_group_id' => 71,
            ],

            //72. Allowances

            [
                'reference_number' => '7/2/1',
                'name' => 'Acting/Responsibility Allowances',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/2',
                'name' => 'Commuted Travelling Allowances',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/3',
                'name' => 'Disturbance Allowance',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/4',
                'name' => 'Home to Duty Travelling Allowance',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/5',
                'name' => 'Living Out Allowance',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/6',
                'name' => 'Official Travelling Allowance',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/7',
                'name' => 'Ration Allowance',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/8',
                'name' => 'Rent Allowance',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/9',
                'name' => 'Subsistence Allowance / Hardlying Allowance',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/10',
                'name' => 'Trade Pay',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/11',
                'name' => 'Uniform Allowance / Civilian Clothing Allowance',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/12',
                'name' => 'Telephone Allowance',
                'index_sub_group_id' => 72,
            ],
            [
                'reference_number' => '7/2/13',
                'name' => 'Overseas Travel Allowance',
                'index_sub_group_id' => 72,
            ],

            //73. Pay Matters

            [
                'reference_number' => '7/3/1',
                'name' => 'Pay Matters',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/2',
                'name' => 'Pay Review / Special Service Pay',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/3',
                'name' => 'Income Tax',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/4',
                'name' => 'National Insurance',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/5',
                'name' => 'Health Surcharge',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/6',
                'name' => 'Terminal Benefits – Pension / Gratuity / Disability Allowance / Linking of Service for the purpose of Pension',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/7',
                'name' => 'Condition of Service – Chief of Defence Staff',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/8',
                'name' => 'Government Loans / Equity in Service',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/9',
                'name' => 'WASA / T&TEC / TSTT Payments',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/10',
                'name' => '10.	Increased Benefits for Officers of the TTDF resulting of Injury or Death arising out of an in the course of Employment',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/11',
                'name' => 'Monthly Statement of Expenditure',
                'index_sub_group_id' => 73,
            ],
            [
                'reference_number' => '7/3/12',
                'name' => 'Loss of Government Property',
                'index_sub_group_id' => 73,
            ],

            //74. Tenders Board

            [
                'reference_number' => '7/4/1',
                'name' => 'Aircraft / Helicopter',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/2',
                'name' => 'Vehicle / Spares',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/3',
                'name' => 'Clothing / Equipment',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/4',
                'name' => 'TTS Chaguaramas / TTS Bucco Reef',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/5',
                'name' => 'TTS Barracuda / TTS Cascadura (CG6',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/6',
                'name' => 'TTS El Tucuche / TTS Naparima',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/7',
                'name' => 'WASPS – TTS Plymouth, Caroni, Galeota, Moruga',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/8',
                'name' => 'Pirogues / Life Boats',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/9',
                'name' => 'Communication / Electronics',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/10',
                'name' => 'Harts Cut Vessels',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/11',
                'name' => 'Acquisition of Vessels / OPVs',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/12',
                'name' => 'Acquisition of Spares CG Vessels',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/13',
                'name' => 'Optical / Dental',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/14',
                'name' => 'Laundry Service',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/15',
                'name' => 'Humming Bird II & III',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/16',
                'name' => 'Food Stuff',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/17',
                'name' => 'Serviceability of Vessels, Vehicles & Aircraft',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/18',
                'name' => '18.	Coast Guard Patrol Boats (TTS Corozola & TTS Crown Point CG 7 and CG8)',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/19',
                'name' => 'TTS Bacolet Pt (CG 10)',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/20',
                'name' => 'TTS NELSON (CG20)	',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/21',
                'name' => 'TTS Gaspar Grande',
                'index_sub_group_id' => 74,
            ],
            [
                'reference_number' => '7/4/22',
                'name' => 'TTS Chacachacare',
                'index_sub_group_id' => 74,
            ],

            //75. Funds

            [
                'reference_number' => '7/5/1',
                'name' => 'Transfer of Votes / Request for Addition Funds / TTR Sports Fund',
                'index_sub_group_id' => 75,
            ],
            [
                'reference_number' => '7/5/2',
                'name' => 'Audit Queries / Audit',
                'index_sub_group_id' => 75,
            ],
            [
                'reference_number' => '7/5/3',
                'name' => 'Crown Agents',
                'index_sub_group_id' => 75,
            ],
            [
                'reference_number' => '7/5/4',
                'name' => 'Imprest Cash',
                'index_sub_group_id' => 75,
            ],
            [
                'reference_number' => '7/5/5',
                'name' => 'CDS Fund / CO’s Fund / Welfare Fund',
                'index_sub_group_id' => 75,
            ],
            [
                'reference_number' => '7/5/6',
                'name' => 'Car Loans – Defence Force Officers',
                'index_sub_group_id' => 75,
            ],
            [
                'reference_number' => '7/5/7',
                'name' => 'Allocation of Funds to the Security Forces',
                'index_sub_group_id' => 75,
            ],
            [
                'reference_number' => '7/5/8',
                'name' => 'Regiment Central Account',
                'index_sub_group_id' => 75,
            ],
            [
                'reference_number' => '7/5/9',
                'name' => 'Accountable Advance',
                'index_sub_group_id' => 75,
            ],
            [
                'reference_number' => '7/5/10',
                'name' => 'Specimen Signature',
                'index_sub_group_id' => 75,
            ],
            [
                'reference_number' => '7/5/11',
                'name' => 'Fuelling Arrangements / Oil',
                'index_sub_group_id' => 75,
            ],

        ];

        foreach ($financialAndAccountingMattersSubjects as $subject) {
            IndexSubject::create($subject);
        }
    }
}

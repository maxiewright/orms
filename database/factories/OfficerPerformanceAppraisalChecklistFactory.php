<?php

namespace Database\Factories;

use App\Models\OfficerAppraisalGrade;
use App\Models\Serviceperson;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfficerPerformanceAppraisalChecklist>
 */
class OfficerPerformanceAppraisalChecklistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $appraisalStart = fake()->dateTimeBetween('-5 years', 'now');
        $appraisalEnd = (new Carbon($appraisalStart))->addYear();
        $hasCompanyCommander = fake()->boolean();
        $hasCompanyCommanderComments = $hasCompanyCommander ?: false;
        $hasCompanyCommanderSignature = $hasCompanyCommander ?: false;
        $hasUnitCommander = fake()->boolean();
        $hasUnitCommanderComments = $hasUnitCommander ?: false;
        $hasUnitCommanderSignature = $hasUnitCommander ?: false;
        $hasDisciplinaryAction = fake()->boolean();
        ($hasDisciplinaryAction)
            ? $disciplinaryActionParticulars = fake()->paragraph()
            : $disciplinaryActionParticulars = null;


        return [
            'serviceperson_number' => 198,
            'appraisal_start_at' => $appraisalStart,
            'appraisal_end_at' => $appraisalEnd,
            'is_appointment_correct' => fake()->boolean(),
            'is_assessment_rubric_complete' => fake()->boolean(),
            'has_company_commander' => $hasCompanyCommander,
            'has_company_commander_comments' => $hasCompanyCommanderComments,
            'has_company_commander_signature' => $hasCompanyCommanderSignature,
            'has_unit_commander' => $hasUnitCommander,
            'has_unit_commander_comments' => $hasUnitCommanderComments,
            'has_unit_commander_signature' => $hasUnitCommanderSignature,
            'officer_appraisal_grade_id' => OfficerAppraisalGrade::all()->random()->id,
            'has_disciplinary_action' => $hasDisciplinaryAction,
            'disciplinary_action_particulars' => $disciplinaryActionParticulars,
            'has_formation_commander_comments' => fake()->boolean(),
            'has_formation_commander_signature' => fake()->boolean(),
            'has_serviceperson_signature' => fake()->boolean(),
        ];
    }
}

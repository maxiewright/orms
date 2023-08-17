<?php

namespace App\Traits;

use App\Enums\OfficerAppraisalGradeEnum;
use Illuminate\Database\Eloquent\Builder;

trait HasCompletionScopes
{
    public function scopeAssessmentRubricCompleted(Builder $query): void
    {
        $query->where('is_appointment_correct', true)
            ->where('is_assessment_rubric_complete', true);
    }

    public function scopeCompletedByCompanyCommander(Builder $query): void
    {
        $query->where('has_company_commander_comments', true)
            ->where('has_company_commander_signature', true);
    }

    public function scopeUngraded(Builder $query): void
    {
        $query->where('officer_appraisal_grade_id',
            OfficerAppraisalGradeEnum::not_graded->value);
    }

    public function scopeHaveDisciplinaryAction(Builder $query): void
    {
        $query->where('has_disciplinary_action', true);
    }

    public function scopeCompletedByUnitCommander(Builder $query): void
    {
        $query->where('has_unit_commander_comments', true)
            ->where('has_unit_commander_signature', true);
    }

    public function scopeCompletedByFormationCommander(Builder $query): void
    {
        $query->where('has_formation_commander_comments', true)
            ->where('has_formation_commander_signature', true);
    }

    public function scopeSignedByServiceperson(Builder $query): void
    {
        $query->where('has_serviceperson_signature', true);
    }

    public function scopeHaveAllLevelsOfCommand(Builder $query): void
    {
        $query->where('has_company_commander', true)
            ->where('has_unit_commander', true);
    }

    public function scopeHaveUnitAndFormationCommand(Builder $query): void
    {
        $query->where('has_company_commander', false)
            ->where('has_unit_commander', true);
    }

    public function scopeHaveFormationCommandOnly(Builder $query): void
    {
        $query->where('has_company_commander', false)
            ->where('has_unit_commander', false);
    }

    public function scopeCompletedHavingFormationCommandOnly(Builder $query): void
    {
        $query->haveFormationCommandOnly()
            ->assessmentRubricCompleted()
            ->completedByFormationCommander()
            ->signedByServiceperson();
    }

    public function scopeCompletedHavingUnitAndFormationCommand(Builder $query): void
    {
        $query->haveUnitAndFormationCommand()
            ->assessmentRubricCompleted()
            ->completedByUnitCommander()
            ->completedByFormationCommander()
            ->signedByServiceperson();
    }

    public function scopeCompletedHavingAllLevelsOfCommand(Builder $query): void
    {
        $query->haveAllLevelsOfCommand()
            ->assessmentRubricCompleted()
            ->completedByCompanyCommander()
            ->completedByUnitCommander()
            ->completedByFormationCommander()
            ->signedByServiceperson();

    }

    public function scopeCompleted(Builder $query): void
    {
        $query->completedHavingFormationCommandOnly()
            ->orWhere
            ->completedHavingUnitAndFormationCommand()
            ->orWhere
            ->CompletedHavingAllLevelsOfCommand();
    }
}

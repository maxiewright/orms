<?php

namespace App\Traits;

use App\Enums\OfficerAppraisalGradeEnum;
use Illuminate\Database\Eloquent\Builder;

trait HasCompletionElements
{
    public function assessmentRubricIsCompleted(): bool
    {
        return $this->is_appointment_correct
            && $this->is_assessment_rubric_complete;
    }

    public function isGraded(): bool
    {
        return $this->officer_appraisal_grade_id
            !== OfficerAppraisalGradeEnum::not_graded->value;
    }

    public function isCompletedByUnitCommander(): bool
    {
        return $this->has_unit_commander_comments
            && $this->has_unit_commander_signature;
    }

    public function isCompletedByFormationCommander(): bool
    {
        return $this->has_formation_commander_comments
            && $this->has_formation_commander_signature;
    }

    public function isSignedByServiceperson()
    {
        return $this->has_serviceperson_signature;
    }

    public function hasAllLevelsOfCommand(): bool
    {
        return $this->has_company_commander
            && $this->has_unit_commander;
    }

    public function hasUnitAndFormationCommand(): bool
    {
        return !$this->has_company_commander
            && $this->has_unit_commander;
    }

    public function hasFormationCommandOnly(): bool
    {
        return !$this->has_company_commander
            && !$this->has_unit_commander;
    }

    public function isCompletedOnlyHavingFormationCommander(): bool
    {
        return $this->hasFormationCommandOnly()
            && $this->assessmentRubricIsCompleted()
            && $this->isCompletedByFormationCommander()
            && $this->isSignedByServiceperson();
    }

    public function isCompletedHavingUnitAndFormationCommander(): bool
    {
        return $this->hasUnitAndFormationCommand()
            && $this->assessmentRubricIsCompleted()
            && $this->isCompletedByUnitCommander()
            && $this->isCompletedByFormationCommander()
            && $this->isSignedByServiceperson();
    }

    public function isCompletedHavingAllLevelsOfCommand(): bool
    {
        return $this->hasAllLevelsOfCommand()
            && $this->assessmentRubricIsCompleted()
            && $this->isCompletedByCompanyCommander()
            && $this->isCompletedByUnitCommander()
            && $this->isCompletedByFormationCommander()
            && $this->isSignedByServiceperson();
    }

    public function isCompleted(): bool
    {
        return $this->isCompletedOnlyHavingFormationCommander()
            || $this->isCompletedHavingUnitAndFormationCommander()
            || $this->isCompletedHavingAllLevelsOfCommand();
    }
}
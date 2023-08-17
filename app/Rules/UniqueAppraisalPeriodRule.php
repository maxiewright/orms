<?php

namespace App\Rules;

use App\Models\OfficerPerformanceAppraisalChecklist;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueAppraisalPeriodRule implements DataAwareRule, ValidationRule
{
    protected $data = [];

    /*
     * This Rule was created to be used with a filamentphp form
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $query = OfficerPerformanceAppraisalChecklist::query()
            ->where('serviceperson_number', $this->data['serviceperson_number'])
            ->where('appraisal_start_at', '>=', $this->data['appraisal_start_at'])
            ->where('appraisal_end_at', '<=', $this->data['appraisal_end_at']);

        if ($query->first()?->serviceperson_number === $this->data['serviceperson_number']) {
            return;
        }

        $startDate = $query->first()?->appraisal_start_at->format('d M Y');
        $endDate = $query->first()?->appraisal_end_at->format('d M Y');

        if ($query->exists()) {
            $fail("This officer has an appraisal for the period {$startDate} to {$endDate}");
        }

    }

    public function setData(array $data): static
    {

        $this->data = $data['data'];

        return $this;
    }
}

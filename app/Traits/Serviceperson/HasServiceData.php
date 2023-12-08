<?php

namespace App\Traits\Serviceperson;

use App\Models\Department;
use App\Models\Metadata\EnlistmentType;
use App\Models\Metadata\Rank;
use App\Models\Metadata\ServiceData\EmploymentStatus;
use App\Models\Metadata\ServiceData\Job;
use App\Models\Unit\Battalion;
use App\Models\Unit\Company;
use App\Models\Unit\Formation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasServiceData
{
    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }

    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    public function enlistmentType(): BelongsTo
    {
        return $this->belongsTo(EnlistmentType::class);
    }

    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class);
    }

    public function battalion(): BelongsTo
    {
        return $this->belongsTo(Battalion::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}

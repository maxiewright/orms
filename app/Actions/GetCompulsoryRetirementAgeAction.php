<?php

namespace App\Actions;

use App\Enums\RankEnum;
use App\Models\Rank;
use Carbon\Carbon;
use DateTime;

class GetCompulsoryRetirementAgeAction
{
    public function __invoke($rank, Carbon $dateOfBirth): Carbon
    {
        return $dateOfBirth->addYears($this->getRetirementAge($rank));
    }

    public function getRetirementAge($rank): int
    {
        return match ($rank) {
            RankEnum::E1, RankEnum::E2, RankEnum::E3, RankEnum::E4 => 45,
            RankEnum::E7, RankEnum::E8, RankEnum::O6 => 50,
            RankEnum::O7, RankEnum::O8, RankEnum::O9 => 55,
            default => 47
        };
    }
}
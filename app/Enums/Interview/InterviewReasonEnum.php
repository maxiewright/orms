<?php

namespace App\Enums\Interview;

enum InterviewReasonEnum: int
{
    case PERFORMANCE = 1;
    case WELFARE = 2;
    case INTERDICTION = 3;
    case PROMOTION = 4;
    case SENIORITY = 5;
    case PERSONAL_MATTER = 6;
    case REDRESS = 7;
}

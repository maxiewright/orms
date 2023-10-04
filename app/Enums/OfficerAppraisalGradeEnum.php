<?php

namespace App\Enums;

enum OfficerAppraisalGradeEnum: int
{
    case EXCELLENT = 1;
    case VERY_GOOD = 2;
    case GOOD = 3;
    case ADEQUATE = 4;
    case WEAK = 5;
    case NOT_GRADED = 6;

}

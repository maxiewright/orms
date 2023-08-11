<?php

namespace App\Enums;

enum OfficerAppraisalGradeEnum: int
{
    case excellent = 1;
    case very_good = 2;
    case good = 3;
    case adequate = 4;
    case weak = 5;
    case not_graded = 6;

}

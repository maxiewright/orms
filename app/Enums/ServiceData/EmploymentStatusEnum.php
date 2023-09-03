<?php

namespace App\Enums\ServiceData;

enum EmploymentStatusEnum: int
{
    case AVAILABLE = 1;
    case PRIVILEGE_LEAVE = 2;
    case SICK_LEAVE = 3;
    case INTERNAL_TRAINING = 4;
    case IN_SERVICE_TRAINING = 5;
    case FOREIGN_MILITARY_TRAINING = 6;
    case RESETTLEMENT_TRAINING = 7;
    case ABSENT_WITHOUT_LEAVE = 8;
    case CONFINED_TO_BARRACKS = 9;
    case DETENTION = 10;

}

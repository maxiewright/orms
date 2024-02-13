<?php

namespace App\Enums\ServiceData;

enum FormationEnum: int
{
    case Regiment = 1;
    case CoastGuard = 2;
    case AirGuard = 3;
    case DefenceForceReserves = 4;
    case DefenceForceHeadquarters = 5;
    case DefenceForceMilitaryAcademy = 6;
}

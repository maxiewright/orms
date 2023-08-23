<?php

namespace App\Enums\ServiceData;

enum EnlistmentTypeEnum: int
{
    case enlisted = 1;
    case regularOfficer = 2;
    case specialServiceOfficer = 3;
}

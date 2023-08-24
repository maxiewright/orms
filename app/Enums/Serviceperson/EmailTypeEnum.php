<?php

namespace App\Enums\Serviceperson;

enum EmailTypeEnum: int
{
    case Personal = 1;
    case Work = 2;
    case Other = 3;
}

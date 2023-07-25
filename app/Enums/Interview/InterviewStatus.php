<?php

namespace App\Enums\Interview;

enum InterviewStatus: int
{
    case pending = 1;
    case canceled = 2;
    case seen = 3;
}

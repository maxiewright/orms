<?php

namespace App\Enums\Interview;

enum InterviewStatusEnum: int
{
    case PENDING = 1;
    case CANCELED = 2;
    case SEEN = 3;
}

<?php

namespace Modules\Legal\Enums\LegalAction;

enum LitigationCategoryType: string
{
    case Type = 'type';

    case Status = 'status';
    case Outcome = 'outcome';
    case Reason = 'reason';

}

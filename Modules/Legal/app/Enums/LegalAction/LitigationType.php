<?php

namespace Modules\Legal\Enums\LegalAction;

enum LitigationType: string
{
    case Lawsuit = 'lawsuit';
    case Petition = 'petition';
}

<?php

namespace Modules\Legal\Enums;

enum InfractionStatus: string
{
    case Charged = 'charged';
    case Pending = 'pending';
    case Dismissed = 'dismissed';

}
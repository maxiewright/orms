<?php

namespace Modules\Registry\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceRoutingPurpose: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    case Action = 'action';
    case Approval = 'approval';
    case AsRequested = 'as_requested';
    case Comment = 'comment';
    case Discussion = 'discussion';
    case Feedback = 'feedback';

    case File = 'file';

    case Information = 'information';
    case Investigate = 'investigate';
    case Other = 'other';
    case ReadAndFile = 'read_and_file';
    case ReadAndReturn = 'read_and_return';
    case Recommend = 'recommend';
    case SeeMe = 'see_me';
    case Signature = 'signature';


    public function getLabel(): ?string
    {
        // TODO: Implement getLabel() method.
    }

    public function getIcon(): ?string
    {
        // TODO: Implement getIcon() method.
    }

    public function getColor(): string|array|null
    {
        // TODO: Implement getColor() method.
    }

    public function getDescription(): ?string
    {
        // TODO: Implement getDescription() method.
    }

}

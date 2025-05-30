<?php

namespace Modules\Registry\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceRoutingActionOutcome: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    case NotedAndFiled = 'noted_and_filed';
    case FiledWithReminder = 'file_with_reminder';
    case CommentsProvided = 'comments_provided';
    case Actioned = 'actioned';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NotedAndFiled => 'Noted and Filed',
            self::FiledWithReminder => 'Filed with Reminder',
            self::CommentsProvided => 'Comments Provided',
            self::Actioned => 'Actioned',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::NotedAndFiled => 'heroicon-o-document-check',
            self::FiledWithReminder => 'heroicon-o-clock',
            self::CommentsProvided => 'heroicon-o-chat-bubble-left-right',
            self::Actioned => 'heroicon-o-check-circle',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NotedAndFiled => 'info',
            self::FiledWithReminder => 'warning',
            self::CommentsProvided => 'primary',
            self::Actioned => 'success',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::NotedAndFiled => 'The correspondence has been noted and filed without further action',
            self::FiledWithReminder => 'The correspondence has been filed with a reminder for future action',
            self::CommentsProvided => 'Comments have been provided on the correspondence',
            self::Actioned => 'The required action has been completed',
        };
    }
}

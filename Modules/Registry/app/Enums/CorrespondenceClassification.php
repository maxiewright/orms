<?php

namespace Modules\Registry\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceClassification: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    case TopSecret = 'Top Secret';
    case Secret = 'Secret';
    case Confidential = 'Confidential';
    case Restricted = 'Restricted';
    case Unclassified = 'Unclassified';
    case PersonalAndConfidential = 'Personal & Confidential';
    case StaffInConfidence = 'Staff in Confidence';

    case MedicalInConfidence = 'Medical in Confidence';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TopSecret => 'Top Secret',
            self::Secret => 'Secret',
            self::Confidential => 'Confidential',
            self::Restricted => 'Restricted',
            self::Unclassified => 'Unclassified',
            self::PersonalAndConfidential => 'Personal & Confidential',
            self::StaffInConfidence => 'Staff in Confidence',
            self::MedicalInConfidence => 'Medical in Confidence',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::TopSecret => 'heroicon-o-lock-closed',
            self::Secret => 'heroicon-o-shield-exclamation',
            self::Confidential => 'heroicon-o-eye-slash',
            self::Restricted => 'heroicon-o-shield-check',
            self::Unclassified => 'heroicon-o-document',
            self::PersonalAndConfidential => 'heroicon-o-user-circle',
            self::StaffInConfidence => 'heroicon-o-users',
            self::MedicalInConfidence => 'heroicon-o-heart',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TopSecret => Color::Red,
            self::Secret => Color::Rose,
            self::Confidential => Color::Orange,
            self::Restricted => Color::Amber,
            self::Unclassified => Color::Green,
            self::PersonalAndConfidential => Color::Purple,
            self::StaffInConfidence => Color::Blue,
            self::MedicalInConfidence => Color::Emerald,
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::TopSecret => 'To be handed unopened direct to the Adjutant.',
            self::Secret => 'Secret classification.',
            self::Confidential => 'To be opened and "Registered IN" by Chief Clerk personally.',
            self::Restricted, self::Unclassified => 'To be opened by Chief Clerk – Registry Clerk to "book in" as directed by Chief Clerk.',
            self::PersonalAndConfidential => 'If addressed to an officer by name then the Letter must be delivered unopened to the addressee.',
            self::StaffInConfidence, self::MedicalInConfidence => 'Same as for Confidential Correspondence (STAFF, MEDICAL ETC)',
        };
    }
}

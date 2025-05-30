<?php

namespace Modules\Registry\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceDispatchStatus: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    // For manifest items
    case OnManifestPendingDelivery = 'on_manifest_pending_delivery';
    case DeliveredToAddressee = 'delivered_to_addressee';
    case AcknowledgedByAddressee = 'acknowledged_by_addressee';

    // For email
    case EmailQueued = 'email_queued';
    case EmailSent = 'email_sent';
    case EmailFailed = 'email_failed';
    case EmailDelivered = 'email_delivered';
    case EmailOpened = 'email_opened';

    // For system
    case NotificationSent = 'notification_sent';
    case AcknowledgedInSystem = 'acknowledged_in_system';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::OnManifestPendingDelivery => 'On Manifest (Pending Delivery)',
            self::DeliveredToAddressee => 'Delivered to Addressee',
            self::AcknowledgedByAddressee => 'Acknowledged by Addressee',
            self::EmailQueued => 'Email Queued',
            self::EmailSent => 'Email Sent',
            self::EmailFailed => 'Email Failed',
            self::EmailDelivered => 'Email Delivered',
            self::EmailOpened => 'Email Opened',
            self::NotificationSent => 'Notification Sent',
            self::AcknowledgedInSystem => 'Acknowledged in System',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::OnManifestPendingDelivery => 'heroicon-o-clipboard-document-list',
            self::DeliveredToAddressee => 'heroicon-o-truck',
            self::AcknowledgedByAddressee => 'heroicon-o-check-circle',
            self::EmailQueued => 'heroicon-o-clock',
            self::EmailSent => 'heroicon-o-paper-airplane',
            self::EmailFailed => 'heroicon-o-exclamation-triangle',
            self::EmailDelivered => 'heroicon-o-envelope',
            self::EmailOpened => 'heroicon-o-envelope-open',
            self::NotificationSent => 'heroicon-o-bell',
            self::AcknowledgedInSystem => 'heroicon-o-check-badge',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::OnManifestPendingDelivery => 'warning',
            self::DeliveredToAddressee => 'success',
            self::AcknowledgedByAddressee => 'success',
            self::EmailQueued => 'gray',
            self::EmailSent => 'info',
            self::EmailFailed => 'danger',
            self::EmailDelivered => 'success',
            self::EmailOpened => 'primary',
            self::NotificationSent => 'info',
            self::AcknowledgedInSystem => 'success',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::OnManifestPendingDelivery => 'The correspondence is on a manifest and pending delivery',
            self::DeliveredToAddressee => 'The correspondence has been delivered to the addressee',
            self::AcknowledgedByAddressee => 'The addressee has acknowledged receipt of the correspondence',
            self::EmailQueued => 'The email is queued for sending',
            self::EmailSent => 'The email has been sent',
            self::EmailFailed => 'The email failed to send',
            self::EmailDelivered => 'The email has been delivered to the recipient\'s inbox',
            self::EmailOpened => 'The email has been opened by the recipient',
            self::NotificationSent => 'A system notification has been sent',
            self::AcknowledgedInSystem => 'The recipient has acknowledged the correspondence in the system',
        };
    }
}

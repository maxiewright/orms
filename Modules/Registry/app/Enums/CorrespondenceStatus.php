<?php

namespace Modules\Registry\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CorrespondenceStatus: string implements HasLabel, HasIcon, HasColor, HasDescription
{
    // Initial Stages
    case Draft = 'draft';
    case SubmittedForReview = 'submitted_for_review';
    case PendingApproval = 'pending_approval';
    case ApprovedForDispatch = 'approved_for_dispatch';

    // Dispatch & Transit Stages
    case Dispatched = 'dispatched';
    case InTransitExternal = 'in_transit_external';
    case ReceivedAtGateway = 'received_at_gateway';
    case InTransitInternal = 'in_transit_internal';
    case DeliveredToRecipientOffice = 'delivered_to_recipient_office';

    // Processing at Destination Stages
    case ReceivedByRecipient = 'received_by_recipient';
    case Acknowledged = 'acknowledged';
    case ActionRequired = 'action_required';
    case BeingActioned = 'being_actioned';
    case RoutingInternallyForAction = 'routing_internally_for_action';
    case PendingInternalSignOff = 'pending_internal_sign_off';

    // Response & Finalization Stages
    case ResponseBeingDrafted = 'response_being_drafted';
    case ResponsePendingReview = 'response_pending_review';
    case ResponsePendingApproval = 'response_pending_approval';
    case ResponseDispatched = 'response_dispatched';

    // Concluding Stages
    case Archived = 'archived';
    case ClassifiedReviewRequired = 'classified_review_required';
    case Delayed = 'delayed';
    case OnHold = 'on_hold';
    case Closed = 'closed';
    case ReturnedToSender = 'returned_to_sender';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::SubmittedForReview => 'Submitted For Review',
            self::PendingApproval => 'Pending Approval',
            self::ApprovedForDispatch => 'Approved For Dispatch',
            self::Dispatched => 'Dispatched',
            self::InTransitExternal => 'In Transit External',
            self::ReceivedAtGateway => 'Received At Gateway',
            self::InTransitInternal => 'In Transit Internal',
            self::DeliveredToRecipientOffice => 'Delivered To Recipient Office',
            self::ReceivedByRecipient => 'Received By Recipient',
            self::Acknowledged => 'Acknowledged',
            self::ActionRequired => 'Action Required',
            self::BeingActioned => 'Being Actioned',
            self::RoutingInternallyForAction => 'Routing Internally For Action',
            self::PendingInternalSignOff => 'Pending Internal Sign Off',
            self::ResponseBeingDrafted => 'Response Being Drafted',
            self::ResponsePendingReview => 'Response Pending Review',
            self::ResponsePendingApproval => 'Response Pending Approval',
            self::ResponseDispatched => 'Response Dispatched',
            self::Archived => 'Archived',
            self::ClassifiedReviewRequired => 'Classified Review Required',
            self::Delayed => 'Delayed',
            self::OnHold => 'On Hold',
            self::Closed => 'Closed',
            self::ReturnedToSender => 'Returned To Sender',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Draft => 'heroicon-o-document',
            self::SubmittedForReview => 'heroicon-o-clipboard-document',
            self::PendingApproval => 'heroicon-o-clock',
            self::ApprovedForDispatch => 'heroicon-o-check',
            self::Dispatched => 'heroicon-o-paper-airplane',
            self::InTransitExternal, self::InTransitInternal => 'heroicon-o-truck',
            self::ReceivedAtGateway => 'heroicon-o-building-office',
            self::DeliveredToRecipientOffice => 'heroicon-o-inbox',
            self::ReceivedByRecipient => 'heroicon-o-hand-raised',
            self::Acknowledged => 'heroicon-o-check-badge',
            self::ActionRequired => 'heroicon-o-exclamation-circle',
            self::BeingActioned => 'heroicon-o-cog',
            self::RoutingInternallyForAction => 'heroicon-o-arrows-right-left',
            self::PendingInternalSignOff => 'heroicon-o-pencil-square',
            self::ResponseBeingDrafted => 'heroicon-o-document-text',
            self::ResponsePendingReview => 'heroicon-o-eye',
            self::ResponsePendingApproval => 'heroicon-o-clipboard-document-check',
            self::ResponseDispatched => 'heroicon-o-paper-airplane',
            self::Archived => 'heroicon-o-archive-box',
            self::ClassifiedReviewRequired => 'heroicon-o-lock-closed',
            self::Delayed => 'heroicon-o-clock',
            self::OnHold => 'heroicon-o-pause',
            self::Closed => 'heroicon-o-check-circle',
            self::ReturnedToSender => 'heroicon-o-arrow-uturn-left',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Draft, self::Archived => Color::Gray,
            self::SubmittedForReview, self::BeingActioned => Color::Blue,
            self::PendingApproval, self::ResponsePendingApproval => Color::Yellow,
            self::ApprovedForDispatch, self::ResponseDispatched, self::Closed => Color::Green,
            self::Dispatched, self::ResponsePendingReview => Color::Indigo,
            self::InTransitExternal, self::InTransitInternal => Color::Purple,
            self::ReceivedAtGateway, self::DeliveredToRecipientOffice => Color::Cyan,
            self::ReceivedByRecipient => Color::Emerald,
            self::Acknowledged => Color::Teal,
            self::ActionRequired, self::Delayed => Color::Orange,
            self::RoutingInternallyForAction => Color::Violet,
            self::PendingInternalSignOff, self::OnHold => Color::Amber,
            self::ResponseBeingDrafted => Color::Sky,
            self::ClassifiedReviewRequired => Color::Red,
            self::ReturnedToSender => Color::Rose,
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Draft => 'Document is being drafted, not yet official',
            self::SubmittedForReview => 'Submitted for internal review before dispatch',
            self::PendingApproval => 'Awaiting approval from a commanding officer or authority',
            self::ApprovedForDispatch => 'Approved and ready for sending',
            self::Dispatched => 'Officially sent out from the originating unit/office',
            self::InTransitExternal => 'In transit between different major commands or organizations',
            self::ReceivedAtGateway => 'Received at a central mail processing facility or entry point of a large base/organization',
            self::InTransitInternal => 'In transit within the destination base/organization to the specific office/recipient',
            self::DeliveredToRecipientOffice => 'Delivered to the recipient\'s specific office or mailroom',
            self::ReceivedByRecipient => 'Confirmed receipt by the intended individual or action office',
            self::Acknowledged => 'Receipt formally acknowledged, awaiting further action',
            self::ActionRequired => 'Correspondence requires specific action from the recipient',
            self::BeingActioned => 'Actively being worked on or addressed',
            self::RoutingInternallyForAction => 'Being routed to specific individuals/departments for their input or action',
            self::PendingInternalSignOff => 'Response or action is drafted and awaiting internal sign-offs at the receiving end',
            self::ResponseBeingDrafted => 'A response to the correspondence is being created',
            self::ResponsePendingReview => 'Drafted response is awaiting internal review',
            self::ResponsePendingApproval => 'Drafted response is awaiting approval before dispatch',
            self::ResponseDispatched => 'Response has been sent',
            self::Archived => 'Correspondence cycle complete, filed for record',
            self::ClassifiedReviewRequired => 'Requires special handling or review due to classification',
            self::Delayed => 'Progress is stalled for a noted reason',
            self::OnHold => 'Action temporarily suspended',
            self::Closed => 'All actions completed, no further activity expected',
            self::ReturnedToSender => 'Could not be delivered or actioned, returned to originator',
        };
    }
}

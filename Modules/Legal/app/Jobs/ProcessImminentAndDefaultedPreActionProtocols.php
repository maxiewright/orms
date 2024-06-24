<?php

namespace Modules\Legal\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use Modules\Legal\Models\LegalAction\PreActionProtocol;
use Modules\Legal\Notifications\SendPreActionProtocolDefaultedNotification;
use Modules\Legal\Notifications\SendPreActionProtocolResponseImminentNotification;

class ProcessImminentAndDefaultedPreActionProtocols implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $legalStaff = User::query()->with('serviceperson')->role([
            'legal_clerk',
            'legal_admin_clerk',
            'legal_senior_enlisted_advisor',
            'legal_officer',
        ])->get();

        $imminentProtocols = PreActionProtocol::query()->responseImminent()->get();
        $defaultedProtocols = PreActionProtocol::query()->defaulted()->get();

        Notification::send($legalStaff, new SendPreActionProtocolResponseImminentNotification($imminentProtocols));
        Notification::send($legalStaff, new SendPreActionProtocolDefaultedNotification($defaultedProtocols));
    }
}

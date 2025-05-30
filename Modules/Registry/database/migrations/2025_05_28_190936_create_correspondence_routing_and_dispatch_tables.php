<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Registry\Models\Correspondence;
use Modules\Registry\Models\CorrespondenceRecipient;
use Modules\Registry\Models\CorrespondenceRouting;
use Modules\Registry\Models\CorrespondenceDispatchManifest;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('correspondence_routings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Correspondence::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CorrespondenceRouting::class, 'parent_id')->nullable()->constrained();
            $table->morphs('routed_by');
            $table->morphs('routed_to');
            $table->timestamp('routing_at');
            $table->string('purpose', 100)->index();
            $table->text('instructions_or_initial_remarks')->nullable();
            $table->string('status', 50)->index();

            // Routing slip receipt confirmation
            $table->foreignIdFor(User::class, 'received_by')->nullable()->constrained('users');
            $table->timestamp('received_at')->nullable();

            // Action/Response from the recipient of the routing slip
            $table->text('action_taken_remarks')->nullable();
            $table->string('action_outcome', 100)->nullable();
            $table->timestamp('actioned_at')->nullable();
            $table->timestamp('bring_up_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('correspondence_dispatch_manifests', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->morphs('destination'); // Morphs to allow flexibility in destination types
            $table->foreignIdFor(User::class, 'prepared_by')->constrained('users');
            $table->timestamp('prepared_at');
            $table->string('status', 50)->index();

            // Courier (Dispatch Rider) details
            $table->foreignIdFor(User::class, 'courier_id')->nullable()->constrained('users');
            $table->timestamp('courier_collected_at')->nullable();
            $table->timestamp('courier_delivered_at')->nullable();

            // Manifest Receipt confirmation
            $table->foreignIdFor(User::class, 'received_by')->nullable()->constrained('users');
            $table->timestamp('received_at')->nullable();

            $table->string('scanned_form_path')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('correspondence_dispatches', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CorrespondenceRecipient::class)->constrained();
            $table->string('method', 50)->index();
            $table->foreignIdFor(CorrespondenceDispatchManifest::class)->nullable()->constrained();
            $table->foreignIdFor(User::class, 'actioned_by')->constrained();
            $table->timestamp('actioned_at');
            $table->string('status', 50)->index();
            $table->timestamp('recipient_received_at')->nullable();
            $table->foreignIdFor(User::class, 'receipt_acknowledged_by')->nullable()->constrained();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });



    }
};

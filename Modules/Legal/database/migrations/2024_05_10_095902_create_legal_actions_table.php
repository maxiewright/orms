<?php

use App\Models\Serviceperson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Legal\Models\Ancillary\Interdication\ReferenceDocument;
use Modules\Legal\Models\LegalAction;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('legal_actions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('status');
            $table->dateTime('started_at');
            $table->dateTime('respond_by');
            $table->dateTime('responded_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->text('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('serviceperson_legal_action', function (Blueprint $table) {
            $table->foreignIdFor(Serviceperson::class);
            $table->foreignIdFor(LegalAction::class);
            $table->unique(['serviceperson_number', 'legal_action_id'], 'serviceperson_legal_action');
            $table->timestamps();
        });

        Schema::create('legal_action_reference_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LegalAction::class);
            $table->foreignIdFor(ReferenceDocument::class);
            $table->text('particulars')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_action_reference_documents');
        Schema::dropIfExists('legal_actions');
    }
};

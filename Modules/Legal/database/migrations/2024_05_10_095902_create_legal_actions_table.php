<?php

use App\Models\Metadata\Contact\City;
use App\Models\Metadata\Contact\Division;
use App\Models\Serviceperson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;
use Modules\Legal\Models\Ancillary\Litigation\LitigationReason;
use Modules\Legal\Models\Ancillary\Litigation\LitigationRuling;
use Modules\Legal\Models\Ancillary\Litigation\PreActionProtocolType;
use Modules\Legal\Models\LegalAction\Defendant;
use Modules\Legal\Models\LegalAction\PreActionProtocol;
use Modules\Legal\Models\Litigation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('litigation_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('litigation_rulings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pre_action_protocol_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('defendants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('abbreviation')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->foreignIdFor(Division::class)->nullable()->constrained();
            $table->foreignIdFor(City::class)->nullable()->constrained();
            $table->text('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pre_action_protocols', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->unique();
            $table->foreignIdFor(PreActionProtocolType::class)->constrained();
            $table->foreignId('parent_id')->nullable()->constrained('pre_action_protocols');
            $table->dateTime('dated_at');
            $table->foreignId('received_by')->constrained('servicepeople', 'number');
            $table->dateTime('received_at');
            $table->dateTime('respond_by');
            $table->string('status');
            $table->dateTime('responded_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('litigations', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->string('type');
            $table->string('status');
            $table->foreignIdFor(PreActionProtocol::class)->nullable()->constrained();
            $table->foreignIdFor(LitigationReason::class)->constrained();
            $table->foreignIdFor(LitigationRuling::class)->nullable()->constrained();
            $table->dateTime('filed_at');
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();
            $table->text('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('serviceperson_litigation', function (Blueprint $table) {
            $table->foreignIdFor(Serviceperson::class);
            $table->foreignIdFor(Litigation::class);
            $table->unique(['serviceperson_number', 'litigation_id'], 'serviceperson_litigation_unique');
            $table->timestamps();
        });

        Schema::create('serviceperson_pre_action_protocol', function (Blueprint $table) {
            $table->foreignIdFor(Serviceperson::class);
            $table->foreignIdFor(PreActionProtocol::class);
            $table->unique(['serviceperson_number', 'pre_action_protocol_id'], 'serviceperson_pre_action_protocol_unique');
            $table->timestamps();
        });

        Schema::create('defendant_litigation', function (Blueprint $table) {
            $table->foreignIdFor(Defendant::class)->constrained();
            $table->foreignIdFor(Litigation::class)->constrained();
            $table->unique(['defendant_id', 'litigation_id'], 'defendant_litigation_unique');
            $table->timestamps();
        });

        Schema::create('defendant_pre_action_protocol', function (Blueprint $table) {
            $table->foreignIdFor(Defendant::class)->constrained();
            $table->foreignIdFor(PreActionProtocol::class)->constrained();
            $table->unique(['defendant_id', 'pre_action_protocol_id'], 'defendant_pre_action_protocol_unique');
            $table->timestamps();
        });

        Schema::create('legal_professional_pre_action_protocol', function (Blueprint $table) {
            $table->foreignIdFor(LegalProfessional::class)->constrained();
            $table->foreignIdFor(PreActionProtocol::class)->constrained();
            $table->unique(['legal_professional', 'pre_action_protocol_id'], 'legal_professional_pre_action_protocol_unique');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defendant_pre_action_protocol');
        Schema::dropIfExists('defendant_litigation');
        Schema::dropIfExists('serviceperson_pre_action_protocol');
        Schema::dropIfExists('serviceperson_litigation');
        Schema::dropIfExists('litigations');
        Schema::dropIfExists('pre_action_protocol_types');
        Schema::dropIfExists('defendants');
        Schema::dropIfExists('litigation_rulings');
        Schema::dropIfExists('litigation_reasons');
    }
};

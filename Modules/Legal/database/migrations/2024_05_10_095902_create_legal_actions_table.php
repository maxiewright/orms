<?php

use App\Models\Metadata\Contact\City;
use App\Models\Metadata\Contact\Division;
use App\Models\Serviceperson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Legal\Models\Ancillary\CourtAppearance\LegalProfessional;
use Modules\Legal\Models\Ancillary\Litigation\LitigationCategory;
use Modules\Legal\Models\Ancillary\Litigation\LitigationReason;
use Modules\Legal\Models\Ancillary\Litigation\PreActionProtocolType;
use Modules\Legal\Models\CourtAppearance;
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
        Schema::create('litigation_categories', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unique(['type', 'name'], 'litigation_category_type_name_unique');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pre_action_protocol_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
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
            $table->text('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pre_action_protocol_extensions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PreActionProtocol::class);
            $table->dateTime('extended_on');
            $table->dateTime('extended_to');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['pre_action_protocol_id', 'extended_to'], 'pre_action_protocol_extension_date');
        });

        Schema::create('litigations', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->foreignId('type_id')->constrained('litigation_categories');
            $table->foreignId('status_id')->constrained('litigation_categories');
            $table->foreignIdFor(PreActionProtocol::class)->nullable()->constrained();
            $table->foreignId('reason_id')->constrained('litigation_categories');
            $table->foreignId('outcome_id')->nullable()->constrained('litigation_categories');
            $table->foreignIdFor(LitigationReason::class)->constrained();
            $table->foreignIdFor(LitigationCategory::class)->nullable()->constrained();
            $table->dateTime('filed_at');
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();
            $table->integer('damages_awarded')->nullable();
            $table->date('settlement_date')->nullable();
            $table->integer('settlement_amount')->nullable();
            $table->text('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('serviceperson_litigation', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Serviceperson::class);
            $table->foreignIdFor(Litigation::class);
            $table->unique(['serviceperson_number', 'litigation_id'], 'serviceperson_litigation_unique');
            $table->timestamps();
        });

        Schema::create('serviceperson_pre_action_protocol', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Serviceperson::class);
            $table->foreignIdFor(PreActionProtocol::class);
            $table->unique(['serviceperson_number', 'pre_action_protocol_id'], 'serviceperson_pre_action_protocol_unique');
            $table->timestamps();
        });

        Schema::create('defendant_litigation', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Defendant::class)->constrained();
            $table->foreignIdFor(Litigation::class)->constrained();
            $table->unique(['defendant_id', 'litigation_id'], 'defendant_litigation_unique');
            $table->timestamps();
        });

        Schema::create('defendant_pre_action_protocol', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Defendant::class)->constrained();
            $table->foreignIdFor(PreActionProtocol::class)->constrained();
            $table->unique(['defendant_id', 'pre_action_protocol_id'], 'defendant_pre_action_protocol_unique');
            $table->timestamps();
        });

        Schema::create('legal_professional_pre_action_protocol', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LegalProfessional::class)
                ->constrained(indexName: 'pre_action_protocol_legal_professional');
            $table->foreignIdFor(PreActionProtocol::class)
                ->constrained(indexName: 'legal_professional_pre_action_protocol');
            $table->unique(['legal_professional_id', 'pre_action_protocol_id'], 'legal_professional_pre_action_protocol_unique');
            $table->timestamps();
        });

        Schema::create('litigation_court_appearance', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Litigation::class)->constrained();
            $table->foreignIdFor(CourtAppearance::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('litigation_court_appearance');
        Schema::dropIfExists('legal_professional_pre_action_protocol');
        Schema::dropIfExists('defendant_pre_action_protocol');
        Schema::dropIfExists('defendant_litigation');
        Schema::dropIfExists('serviceperson_pre_action_protocol');
        Schema::dropIfExists('serviceperson_litigation');
        Schema::dropIfExists('litigations');
        Schema::dropIfExists('pre_action_protocol_extensions');
        Schema::dropIfExists('pre_action_protocols');
        Schema::dropIfExists('pre_action_protocol_types');
        Schema::dropIfExists('defendants');
        Schema::dropIfExists('litigation_rulings');
        Schema::dropIfExists('litigation_reasons');
    }
};

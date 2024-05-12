<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondenceType;
use Modules\Legal\Models\Infraction;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('legal_correspondence_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('legal_correspondences', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->dateTime('date');
            $table->string('name');
            $table->string('subject');
            $table->string('slug');
            $table->foreignIdFor(LegalCorrespondenceType::class)->constrained();
            $table->string('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('referenceables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LegalCorrespondence::class);
            $table->morphs('referenceable');
            $table->timestamps();
        });

        Schema::create('interdictions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Infraction::class)->constrained()->cascadeOnDelete();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('status');
            $table->text('particulars');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interdiction_reference_document');
        Schema::dropIfExists('interdiction');
        Schema::dropIfExists('reference_documents');
        Schema::dropIfExists('reference_document_types');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondence;
use Modules\Legal\Models\Ancillary\Interdiction\LegalCorrespondenceType;
use Modules\Legal\Models\Incident;

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
            $table->foreignIdFor(LegalCorrespondenceType::class)->constrained();
            $table->string('reference');
            $table->dateTime('date');
            $table->string('name');
            $table->string('slug');
            $table->string('subject');
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
            $table->foreignIdFor(Incident::class)
                ->unique()
                ->constrained()
                ->cascadeOnDelete();
            $table->dateTime('requested_at');
            $table->dateTime('interdicted_at')->nullable();
            $table->dateTime('revoked_at')->nullable();
            $table->string('status');
            $table->text('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interdictions');
        Schema::dropIfExists('referenceables');
        Schema::dropIfExists('legal_correspondences');
        Schema::dropIfExists('legal_correspondence_types');
    }
};

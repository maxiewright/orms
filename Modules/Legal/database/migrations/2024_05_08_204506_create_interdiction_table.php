<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Legal\Models\Ancillary\Interdication\ReferenceDocument;
use Modules\Legal\Models\Ancillary\Interdication\ReferenceDocumentType;
use Modules\Legal\Models\Infraction;
use Modules\Legal\Models\Interdiction;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reference_document_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
        Schema::create('reference_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('index');
            $table->foreignIdFor(ReferenceDocumentType::class)->constrained();
            $table->string('abbreviation')->nullable();
            $table->dateTime('date');
            $table->string('particulars')->nullable();
            $table->timestamps();
            $table->softDeletes();
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

        Schema::create('interdiction_reference_document', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Interdiction::class)->constrained();
            $table->foreignIdFor(ReferenceDocument::class)->constrained();
            $table->text('particulars')->nullable();
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

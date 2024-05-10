<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Legal\Enums\JusticeInstitutionType;
use Modules\Legal\Models\Ancillary\JusticeInstitution;
use Modules\Legal\Models\Infraction;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('incarcerations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Infraction::class)->constrained()->cascadeOnDelete();
            $table->dateTime('incarcerated_at');
            $table->foreignIdFor(JusticeInstitution::class)->constrained();
            $table->dateTime('released_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incarcerations');
        Schema::dropIfExists('prisons');
    }
};

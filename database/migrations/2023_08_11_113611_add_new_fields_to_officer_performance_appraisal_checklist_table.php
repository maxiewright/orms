<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('officer_performance_appraisal_checklists', function (Blueprint $table) {
            $table->foreignId('battalion_id')
                ->after('appraisal_end_at')
                ->nullable()
                ->constrained();
            $table->foreignId('rank_id')
                ->after('battalion_id')
                ->nullable()
                ->constrained();
            $table->tinyText('non_grading_reason')
                ->after('officer_appraisal_grade_id')
                ->nullable();

        });
    }
};

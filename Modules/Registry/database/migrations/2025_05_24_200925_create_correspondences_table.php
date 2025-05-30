<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Registry\Models\Correspondence;
use Modules\Registry\Models\Tag;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('correspondences', function (Blueprint $table): void {
            $table->id();
            $table->string('file_path')->nullable()->unique();
            $table->string('reference_number')->unique();
            $table->string('external_reference')->nullable();
            $table->timestamp('correspondence_date');
            $table->string('slug')->unique();
            $table->string('subject', 255);
            $table->longText('body')->nullable();
            $table->string('status', 50);

            // Classification and handling
            $table->string('type', 50);
            $table->string('classification', 50);
            $table->string('priority', 50);
            $table->string('security_caveats', 255)->nullable();

            // Correspondence Response
            $table->boolean('response_required');
            $table->timestamp('response_due_by')->nullable();
            $table->foreignIdFor(Correspondence::class, 'response_to')
                ->nullable()
                ->constrained();

            // Correspondence tracking
            $table->morphs('sender');
            $table->nullableMorphs('sender_location');
            $table->foreignId('dispatched_by')->nullable()->constrained('users');
            $table->string('dispatch_method', 50)->nullable();
            $table->timestamp('dispatched_at')->nullable();

            $table->text('description')->nullable();
            $table->text('action_required')->nullable(); // Specific action required from recipient
            $table->timestamp('actioned_at')->nullable();

            // Indexes for performance
            $table->index('response_to');
            $table->timestamps();
            $table->foreignIdFor(User::class, 'created_by')->constrained();
            $table->foreignIdFor(User::class, 'updated_by')->nullable()->constrained();
            $table->softDeletes();
        });

        Schema::table('correspondence_recipients', function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(Correspondence::class)
                ->constrained('correspondences')
                ->onDelete('cascade');

            $table->morphs('recipient');
            $table->nullableMorphs('recipient_location');

            $table->string('type', 50)->nullable();

            // Action required
            $table->date('action_by')->nullable();
            $table->string('action_status', 50)->nullable();
            $table->timestamp('actioned_at')->nullable();

            $table->foreignId('received_by')->nullable()->constrained('users');
            $table->timestamp('received_at')->nullable();
            $table->timestamp('viewed_at')->nullable();

            $table->timestamps();

        });

        Schema::create('correspondence_references', function (Blueprint $table): void {
            $table->id();

            $table->foreignIdFor(Correspondence::class, 'source_correspondence_id')
                ->constrained('correspondences');

            $table->foreignIdFor(Correspondence::class, 'related_correspondence_id')
                ->constrained('correspondences');

            $table->string('reference_type', 50)->nullable();
            $table->timestamps();

            $table->unique([
                'source_correspondence_id',
                'related_correspondence_id',
            ], 'correspondence_references_unique');
        });

        Schema::create('tags', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('correspondence_tags', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Tag::class)->constrained();
            $table->foreignIdFor(Correspondence::class)->constrained();
            $table->timestamps();
            $table->unique(['tag_id', 'correspondence_id'], 'correspondence_tags_unique');
        });

        Schema::create('correspondence_attachments', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Correspondence::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->string('classification', 50)->nullable();
            $table->string('type', 50)->nullable();

            // Digital details
            $table->string('file_path')->unique()->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->nullable();

            // Physical details
            $table->boolean('is_physical')->default(false);
            $table->string('physical_location')->nullable();
            $table->string('physical_condition')->nullable();
            $table->integer('page_count')->nullable();

            $table->text('access_instructions')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('uploaded_by_user_id')->nullable()->constrained('users');
            $table->timestamps();
        });

    }

};

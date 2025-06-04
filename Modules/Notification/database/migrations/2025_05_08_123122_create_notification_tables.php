<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create user notification preferences table
        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('notification_type')->index(); // Order confirmation, payment reminder, etc.
            $table->json('channels'); // Which channels to use for this notification type
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();
            
            $table->unique(['user_id', 'notification_type']);
        });
        
        // Create notification logs table
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('notifiable'); // Polymorphic relationship for anything that can receive notifications
            $table->string('notification_type')->index();
            $table->string('channel')->index(); // email, sms, whatsapp, telegram, etc.
            $table->json('data'); // Store notification content/payload
            $table->string('status')->default('pending'); // pending, sent, failed, delivered, read
            $table->text('error')->nullable(); // Error message if failed
            $table->integer('attempts')->default(0); // For retry mechanism
            $table->timestamp('read_at')->nullable(); // When the notification was read (if applicable)
            $table->timestamp('sent_at')->nullable(); // When the notification was sent
            $table->timestamp('scheduled_for')->nullable(); // For scheduled notifications
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['notifiable_type', 'notifiable_id', 'status']);
            $table->index('created_at');
        });
        
        // Create notification templates table
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('key')->unique(); // Unique identifier for the template
            $table->string('notification_type')->index();
            $table->json('channels'); // Which channels this template supports
            $table->json('content'); // Multi-language & multi-channel content
            $table->json('actions')->nullable(); // Buttons, links, etc.
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        
        // Create notification rate limits table
        Schema::create('notification_rate_limits', function (Blueprint $table) {
            $table->id();
            $table->morphs('notifiable');
            $table->string('notification_type')->index();
            $table->string('channel')->index();
            $table->integer('count')->default(0);
            $table->date('date');
            $table->timestamps();

            $table->unique(
                ['notifiable_type', 'notifiable_id', 'notification_type', 'channel', 'date'],
                'notif_rlimit_unique' // index name
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_rate_limits');
        Schema::dropIfExists('notification_templates');
        Schema::dropIfExists('notification_logs');
        Schema::dropIfExists('notification_preferences');
    }
};

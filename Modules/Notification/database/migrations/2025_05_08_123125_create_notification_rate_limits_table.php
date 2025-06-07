<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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
                'notif_rlimit_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_rate_limits');
    }
};

<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('default_schedule_cron')->nullable();
            $table->boolean('notifications_enabled')->default(true);
            $table->string('notification_email')->nullable();
            $table->boolean('auto_activate_workflows')->default(false);
            $table->integer('execution_timeout')->default(300);
            $table->timestamps();

            $table->unique('team_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

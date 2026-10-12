<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->enum('role', ['admin', 'trainer', 'member'])->default('member');
            $table->string('profile_photo_url')->nullable();
            $table->date('join_date')->nullable();
            $table->enum('status', ['active', 'cancelled'])->default('active');
            $table->timestamps();
        });

        // 2. Memberships Table
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('plan_name')->default('All-Access Pro');
            $table->enum('plan_type', ['monthly', 'yearly'])->default('monthly');
            $table->decimal('monthly_fee', 10, 2)->default(79.99);
            $table->date('last_paid_date');
            $table->date('next_due_date');
            $table->enum('status', ['paid', 'unpaid', 'due_soon'])->default('paid');
            $table->foreignId('assigned_trainer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

        // 3. Payment Histories Table
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membership_id')->constrained('memberships')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('paid_on');
            $table->string('payment_method')->default('card');
            $table->string('transaction_id')->nullable();
            $table->string('invoice_no')->unique()->nullable();
            $table->foreignId('marked_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

        // 4. Posts Table
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 5. Diet Plans Table
        Schema::create('diet_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->enum('category', ['weight_loss', 'muscle_gain', 'maintenance'])->default('muscle_gain');
            $table->text('description');
            $table->text('breakfast')->nullable();
            $table->text('lunch')->nullable();
            $table->text('dinner')->nullable();
            $table->text('snacks')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 6. Diet Assignments Table
        Schema::create('diet_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diet_plan_id')->constrained('diet_plans')->onDelete('cascade');
            $table->foreignId('member_id')->constrained('users')->onDelete('cascade');
            $table->date('assigned_on');
            $table->timestamps();
        });

        // 7. Notifications Table
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['fee_due', 'system', 'custom'])->default('fee_due');
            $table->foreignId('member_id')->constrained('users')->onDelete('cascade');
            $table->string('message');
            $table->boolean('is_resolved')->default(false);
            $table->enum('resolved_action', ['paid', 'unpaid_whatsapp'])->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });

        // 8. Messages Logs Table
        Schema::create('messages_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->string('subject');
            $table->text('body');
            $table->enum('sent_via', ['gmail', 'system_email'])->default('gmail');
            $table->timestamp('sent_at');
            $table->timestamps();
        });

        // 9. Settings Table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('gym_name')->default('FitCore Fitness Hub');
            $table->string('gym_logo_url')->nullable();
            $table->string('gym_address')->default('1044 Apex Boulevard, Metro Heights, NY');
            $table->decimal('default_monthly_fee', 10, 2)->default(79.99);
            $table->string('email_reminder_subject')->default('FitCore Membership Renewal Reminder - {{due_date}}');
            $table->text('email_reminder_body')->default('Hi {{member_name}}, your monthly fee of ${{amount}} is due on {{due_date}}.');
            $table->text('whatsapp_message_template')->default('Hey {{member_name}}! 🏋️‍♂️ Your FitCore gym fee of ${{amount}} was due on {{due_date}}. Please renew your membership portal access.');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('messages_logs');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('diet_assignments');
        Schema::dropIfExists('diet_plans');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('payment_histories');
        Schema::dropIfExists('memberships');
        Schema::dropIfExists('users');
    }
};

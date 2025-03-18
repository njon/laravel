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
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('id');
            $table->string('job_title')->nullable()->after('full_name');
            $table->string('work_email')->unique()->nullable()->after('job_title');
            $table->string('work_phone')->nullable()->after('work_email');
            $table->enum('access_level', ['basic', 'editor', 'admin'])->default('basic')->after('work_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'job_title', 'work_email', 'work_phone', 'access_level']);
        });
    }
};
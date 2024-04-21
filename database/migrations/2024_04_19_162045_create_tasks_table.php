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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id')->nullable();
            $table->integer('action_id')->nullable();
            $table->string('jira_id')->nullable();
            $table->string('summary')->nullable();
            $table->integer('working_status_id')->nullable();
            $table->integer('ticket_status_id')->nullable();
            $table->integer('instructor_id');
            $table->integer('tester_1_id')->nullable();
            $table->integer('tester_2_id')->nullable();
            $table->string('task_name_slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

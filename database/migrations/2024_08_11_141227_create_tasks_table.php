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
            $table->unsignedBigInteger('board_id');
            $table->unsignedBigInteger('team')->nullable();
            $table->unsignedBigInteger('type')->nullable();
            $table->string('jira_id')->nullable();
            $table->string('jira_summary')->nullable();
            $table->unsignedBigInteger('working_status')->nullable();
            $table->unsignedBigInteger('ticket_status')->nullable();
            $table->string('link_to_result')->nullable();
            $table->string('test_plan')->nullable();
            $table->string('sprint')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('priority')->nullable();
            $table->unsignedBigInteger('tester_1')->nullable();
            $table->unsignedBigInteger('tester_2')->nullable();
            $table->unsignedBigInteger('tester_3')->nullable();
            $table->unsignedBigInteger('tester_4')->nullable();
            $table->unsignedBigInteger('tester_5')->nullable();
            $table->string('task_slug')->nullable();
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

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
        Schema::create('board_configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('board_id');
            $table->tinyInteger('team')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('type')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('jira_id')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('jira_summary')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('working_status')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('ticket_status')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('link_to_result')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('test_plan')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('sprint')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('note')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('tester_1')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('tester_2')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('tester_3')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('tester_4')->default(0)->comment('0=Inactive','1=Active');
            $table->tinyInteger('tester_5')->default(0)->comment('0=Inactive','1=Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_configs');
    }
};

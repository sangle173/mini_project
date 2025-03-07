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
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('board_config_id')->nullable();
            $table->string('title');
            $table->string('desc')->nullable();
            $table->date('start_date');
            $table->string('photo')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=Inactive','1=Active');
            $table->string('board_slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};

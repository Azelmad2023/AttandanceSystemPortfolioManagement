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
        Schema::create('datareceiverattandances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('week_id');
            $table->date('start_date');
            $table->date('end_date');
            // Add columns for days data
            $table->date('day_date');
            $table->string('day_of_week');
            // Add columns for teachers data
            $table->string('teacher_name');
            // Add columns for classes data
            $table->time('class_time_from');
            $table->time('class_time_to');
            $table->string('class_group');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datareceiverattandances');
    }
};

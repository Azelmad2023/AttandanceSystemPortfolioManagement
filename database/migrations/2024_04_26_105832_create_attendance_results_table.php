<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_id');
            $table->foreign('attendance_id')->references('id')->on('datareceiverattandances')->onDelete('cascade');
            $table->enum('attendance_state', ['present', 'absent']);
            $table->boolean('justification')->nullable();
            $table->string('justification_type')->nullable();
            $table->string('justification_document')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_results');
    }
};

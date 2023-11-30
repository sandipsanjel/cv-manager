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
        Schema::create('cv_status', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['shortlisted', 'First Interview', 'Second Interview', 'Third Intervi ew', 'Hired', 'Rejected']);
            $table->string('task');
            $table->date('interview_date');
            $table->string('interviewers_list');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_status');
    }
};

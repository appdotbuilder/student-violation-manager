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
        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('violation_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('violation_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
            $table->date('violation_date')->comment('Date when violation occurred');
            $table->integer('points')->comment('Points deducted (copied from violation type)');
            $table->text('notes')->nullable()->comment('Additional notes about the violation');
            $table->timestamps();
            
            $table->index('violation_date');
            $table->index('points');
            $table->index(['student_id', 'violation_date']);
            $table->index(['recorded_by', 'violation_date']);
            $table->index(['violation_category_id', 'violation_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violations');
    }
};
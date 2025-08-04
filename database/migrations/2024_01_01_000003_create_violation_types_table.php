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
        Schema::create('violation_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('violation_category_id')->constrained()->onDelete('cascade');
            $table->string('name')->comment('Type name (e.g., Terlambat, Tidak Memakai Atribut Lengkap)');
            $table->text('description')->nullable()->comment('Type description');
            $table->integer('points')->comment('Points deducted for this violation type');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->index('name');
            $table->index('points');
            $table->index('status');
            $table->index(['violation_category_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violation_types');
    }
};
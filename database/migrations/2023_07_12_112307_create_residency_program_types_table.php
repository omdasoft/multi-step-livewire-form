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
        Schema::create('residency_program_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dr_profile_id')
            ->references('id')->on('dr_profiles')
            ->cascadeOnDelete();
            $table->boolean('start_program')->nullable()->comment = "0 => Yes || 1 => No";
            $table->boolean('type')->nullable()->comment = "0 => Higher Education || 1 => Residency Program";
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residency_program_types');
    }
};

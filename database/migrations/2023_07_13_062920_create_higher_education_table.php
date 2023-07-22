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
        Schema::create('higher_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('residency_program_type_id')
            ->references('id')->on('residency_program_types')
            ->cascadeOnDelete();
            $table->boolean('type')->nullable()->comment = "0 => PhD || 1 => Master";
            $table->bigInteger('speciality_id')->references('id')->on('specialities');
            $table->bigInteger('country_id')->references('id')->on('countries');
            $table->string('university_name');
            $table->string('years_number')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->longText('certificate_scan')->nullable();
            $table->longText('training_scan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('higher_education');
    }
};

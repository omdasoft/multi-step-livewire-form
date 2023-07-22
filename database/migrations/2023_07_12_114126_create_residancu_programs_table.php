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
        Schema::create('residancu_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('residency_program_type_id')
            ->references('id')->on('residency_program_types')
            ->cascadeOnDelete();
            $table->bigInteger('speciality_id')->references('id')->on('specialities');
            $table->bigInteger('country_id')->references('id')->on('countries');
            $table->bigInteger('sector_id')->references('id')->on('sectors');
            $table->string('hospital_name');
            $table->string('years_number')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->tinyInteger('residency_level')->nullable();
            $table->longText('first_year_scan')->nullable();
            $table->longText('completion_scan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residancu_programs');
    }
};

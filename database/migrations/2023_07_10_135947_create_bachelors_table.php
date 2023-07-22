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
        Schema::create('bachelors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dr_profile_id')
                ->references('id')->on('dr_profiles')
                ->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->references('id')->on('countries');
            $table->foreignId('speciality_id')->nullable()->references('id')->on('bsc_specialities');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('year_no')->nullable();
            $table->string('average')->nullable();
            $table->string('total_marks')->nullable();
            $table->string('file')->nullable();
            $table->string('transcripts')->nullable();
            $table->string('equivalent_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bachelors');
    }
};

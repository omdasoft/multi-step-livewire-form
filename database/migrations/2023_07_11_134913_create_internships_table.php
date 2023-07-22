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
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dr_profile_id')
                ->references('id')->on('dr_profiles')
                ->cascadeOnDelete();
            $table->boolean('internship_certified')->nullable();
            $table->boolean('internship_training')->nullable();
            $table->foreignId('country_id')->nullable()->references('id')->on('countries');
            $table->string('hospital_name')->nullable();
            $table->tinyInteger('sector')->nullable();
            $table->integer('duration')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('termination_doc')->nullable();
            $table->string('certificate')->nullable();
            $table->string('syndicate_doc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};

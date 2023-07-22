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
        Schema::create('high_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dr_profile_id')
                ->references('id')->on('dr_profiles')
                ->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->references('id')->on('countries');
            $table->string('study_field')->nullable();
            $table->date('year')->nullable();
            $table->string('file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('high_schools');
    }
};

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
        Schema::create('cities', function (Blueprint $table) {
          $table->id();
          $table->string('name_en');
          $table->string('name_ar');
          $table->foreignId('country_id')
              ->references('id')
              ->on('countries')->cascadeOnDelete();
          $table->foreignId('state_id')
              ->nullable()
              ->references('id')
              ->on('states')->cascadeOnDelete();
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};

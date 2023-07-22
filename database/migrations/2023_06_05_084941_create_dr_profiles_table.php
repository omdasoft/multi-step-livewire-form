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
        Schema::create('dr_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->tinyInteger('gender')->nullable()->comment = "0 => Male || 1 => Female";
            $table->date('bairthdate')->nullable();
            $table->foreignId('nationality_id')->nullable()->references('id')->on('nationalities');
            $table->text('birthplace')->nullable();
            $table->string('phone')->unique();
            $table->string('phone_country_code')->nullable();
            $table->string('passport_no')->nullable();
            $table->foreignId('country_id')->nullable()->references('id')->on('countries');
            $table->foreignId('state_id')->nullable()->references('id')->on('states');
            $table->foreignId('city_id')->nullable()->references('id')->on('cities');
            $table->text('address')->nullable();
            $table->string('personal_image')->nullable();
            $table->string('passport_copy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dr_profiles');
    }
};

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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->string('iso_code', 2)->unique();   // IN, UK
            $table->string('phone_code', 5);           // +91
            $table->unsignedTinyInteger('phone_min');
            $table->unsignedTinyInteger('phone_max');
            $table->string('postal_regex')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};

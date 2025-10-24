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
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('ident')->nullable();
            $table->string('iata_code')->unique();
            $table->string('name');
            $table->string('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->nullOnDelete()->cascadeOnUpdate();
            $table->string('municipality');
            $table->string('gps_code')->nullable();
            $table->string('local_code')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('timezone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};

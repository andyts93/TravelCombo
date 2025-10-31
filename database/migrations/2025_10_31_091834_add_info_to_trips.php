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
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn('user_timezone');
            $table->string('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->restrictOnDelete()->cascadeOnUpdate();
            $table->date('date_from');
            $table->date('date_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->string('user_timezone')->nullable();
            $table->dropConstrainedForeignId('country_id');
            $table->dropColumn('date_from');
            $table->dropColumn('date_to');
        });
    }
};

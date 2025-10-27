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
        Schema::table('flights', function (Blueprint $table) {
            $table->enum('trip_type', ['outbound', 'inbound'])->default('outbound');
            $table->foreignIdFor(\App\Models\Flight::class, 'linked_flight_id')->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->dropColumn('trip_type');
            $table->dropForeignIdFor(\App\Models\Flight::class, 'linked_flight_id');
        });
    }
};

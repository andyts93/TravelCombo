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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\Airport::class, 'airport_from_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\Airport::class, 'airport_to_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamp('date_from');
            $table->timestamp('date_to');
            $table->unsignedInteger('duration_min')->nullable()->storedAs('TIMESTAMPDIFF(MINUTE, `date_from`, `date_to`)');
            $table->decimal('price', 10);
            $table->unsignedInteger('people')->default(1);
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};

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
    Schema::create('symptoms', function (Blueprint $table) {
        $table->id();
        $table->text('keywords'); // Seeder ke 'keywords' ke liye
        $table->string('condition_name'); // Seeder ke 'condition_name' ke liye
        $table->string('severity_levels');
        $table->string('duration');
        $table->text('emergency_situation');
        $table->json('medications'); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('symptoms');
    }
};

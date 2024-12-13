<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('units', function (Blueprint $table) {
        $table->id(); // Primary key
        $table->string('name')->unique(); // Unit name
        $table->timestamps(); // Timestamps
    });
}

public function down(): void
{
    Schema::dropIfExists('units'); // Rollback: Drop the table
}

};

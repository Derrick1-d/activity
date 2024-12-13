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
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->date('date');                                 // Date of the activity
            $table->string('description');                               // Activity name
            $table->enum('status', ['completed', 'pending', 'in_progress']); // Use snake_case if needed for consistency
            $table->text('comments')->nullable();                 // Comments (optional)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Make user_id nullable
            $table->timestamps();                                 // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
};

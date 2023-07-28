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
        Schema::create('outfit_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outfit_id')->constrained('outfits')->onUpdate('cascade')->onDelete('cascade');
            $table->string('status');
            $table->dateTime('date_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outfit_statuses');
    }
};

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
        Schema::table('outfits', function (Blueprint $table) {
            $table->string('article')->after('order_id')->nullable();
            $table->tinyInteger('production')->after('article')->default(0)
            ->comment('0=not started, 1=Started')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('outfits', function (Blueprint $table) {
            $table->dropColumn('article');
            $table->dropColumn('production');
        });
    }
};

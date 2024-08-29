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
        Schema::table('products', function (Blueprint $table) {
            $table->string('additional_photo_1')->nullable();
            $table->string('additional_photo_2')->nullable();
            $table->string('additional_photo_3')->nullable();
            $table->string('additional_photo_4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('additional_photo_1');
            $table->dropColumn('additional_photo_2');
            $table->dropColumn('additional_photo_3');
            $table->dropColumn('additional_photo_4');
        });
    }
};

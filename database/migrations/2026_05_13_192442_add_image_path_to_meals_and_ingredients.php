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
        if (!Schema::hasColumn('meals', 'image_path')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->string('image_path')->nullable()->after('unit_price');
            });
        }

        if (!Schema::hasColumn('ingredients', 'image_path')) {
            Schema::table('ingredients', function (Blueprint $table) {
                $table->string('image_path')->nullable()->after('kcal_per_100g');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meals', function (Blueprint $table) {
            if (Schema::hasColumn('meals', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });

        Schema::table('ingredients', function (Blueprint $table) {
            if (Schema::hasColumn('ingredients', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });
    }
};

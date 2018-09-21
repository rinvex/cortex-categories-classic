<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCategoriesTableAddStyleAndIconColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(config('rinvex.categories.tables.categories'), function (Blueprint $table) {
            $table->string('style')->after('parent_id')->nullable();
            $table->string('icon')->after('style')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table(config('rinvex.categories.tables.categories'), function (Blueprint $table) {
            $table->dropColumn('icon');
            $table->dropColumn('style');
        });
    }
}

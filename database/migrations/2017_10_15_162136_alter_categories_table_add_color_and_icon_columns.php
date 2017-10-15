<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCategoriesTableAddColorAndIconColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('rinvex.categories.tables.categories'), function (Blueprint $table) {
            $table->string('icon')->nullable();
            $table->string('color', 7)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('rinvex.categories.tables.categories'), function (Blueprint $table) {
            $table->dropColumn('color');
            $table->dropColumn('icon');
        });
    }
}

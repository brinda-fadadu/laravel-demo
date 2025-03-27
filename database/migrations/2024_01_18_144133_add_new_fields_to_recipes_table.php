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
        Schema::table('recipes', function (Blueprint $table) {
            $table->string('total_protein')->after('serving_people')->nullable();
            $table->string('total_carb')->after('serving_people')->nullable();
            $table->string('total_fat')->after('serving_people')->nullable();
            $table->string('calories')->after('serving_people')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('total_protein');
            $table->dropColumn('total_carb');
            $table->dropColumn('total_fat');
            $table->dropColumn('calories');
        });
    }
};

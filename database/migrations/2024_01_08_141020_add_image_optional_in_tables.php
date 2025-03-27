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
        Schema::table('allergies', function (Blueprint $table) {
            $table->string('image')->nullable()->default(null)->change();
        });
        Schema::table('breakfasts', function (Blueprint $table) {
            $table->string('image')->nullable()->default(null)->change();
        });
        Schema::table('desserts', function (Blueprint $table) {
            $table->string('image')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('allergies', function (Blueprint $table) {
            Schema::table('allergies', function (Blueprint $table) {
                $table->string('image')->change();
            });
            Schema::table('breakfasts', function (Blueprint $table) {
                $table->string('image')->change();
            });
            Schema::table('desserts', function (Blueprint $table) {
                $table->string('image')->change();
            });
        });
    }
};

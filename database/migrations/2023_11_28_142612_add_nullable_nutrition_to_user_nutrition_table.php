<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_nutrition', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_by_user_id')->change()->nullable();
            $table->unsignedBigInteger('nutrition_id')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_nutrition', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_by_user_id')->change();
            $table->unsignedBigInteger('nutrition_id')->change();
        });
    }
};

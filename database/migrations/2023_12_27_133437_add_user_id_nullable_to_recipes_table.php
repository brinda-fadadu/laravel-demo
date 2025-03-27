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
            $table->unsignedBigInteger('user_id')->change()->nullable();
            $table->string('dietary_preference')->after('serving_people')->nullable();
            $table->string('heat_level')->after('dietary_preference')->nullable();
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
            $table->unsignedBigInteger('user_id')->change();
            $table->dropColumn(['dietary_preference','heat_level']);
        });
    }
};

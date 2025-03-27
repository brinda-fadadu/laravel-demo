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
        Schema::table('schedule_recipes', function (Blueprint $table) {
            $table->dropColumn('schedule_id');
            $table->unsignedBigInteger('user_id')->after('id')->nullable();
            $table->string('date')->after('day')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_recipes', function (Blueprint $table) {
            $table->dropColumn(['date','user_id']);
            $table->unsignedBigInteger('schedule_id')->after('id');
        });
    }
};

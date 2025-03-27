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
        Schema::table('user_subscriptions', function (Blueprint $table) {
            \DB::statement("
                ALTER TABLE user_subscriptions CHANGE type type ENUM('one_time','monthly','yearly')    DEFAULT NULL
            ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            \DB::statement("
            ALTER TABLE user_subscriptions CHANGE type type ENUM('monthly','yearly') DEFAULT NULL
        ");
        });
    }
};

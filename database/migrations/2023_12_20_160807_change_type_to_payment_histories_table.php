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
        Schema::table('payment_histories', function (Blueprint $table) {
            DB::statement("ALTER TABLE payment_histories CHANGE COLUMN type type ENUM('one_time', 'monthly', 'yearly') NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            DB::statement("ALTER TABLE payment_histories CHANGE COLUMN type type ENUM('monthly', 'yearly') NULL");
        });
    }
};

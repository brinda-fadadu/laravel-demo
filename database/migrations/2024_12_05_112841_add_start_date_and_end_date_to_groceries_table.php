<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('groceries_start_date')->nullable()->after('groceries_day');
            $table->date('groceries_end_date')->nullable()->after('groceries_start_date');
        });

        Schema::table('groceries', function (Blueprint $table) {
            $table->date('week_start_date')->nullable()->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('groceries_start_date');
            $table->dropColumn('groceries_end_date');
        });

        Schema::table('groceries', function (Blueprint $table) {
            $table->dropColumn('week_end_date');
        });
    }
};

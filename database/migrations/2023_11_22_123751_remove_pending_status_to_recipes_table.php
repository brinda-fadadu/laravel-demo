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
        DB::statement("ALTER TABLE recipes CHANGE COLUMN status status ENUM('active', 'inactive') NOT NULL DEFAULT 'inactive'");

        DB::statement("ALTER TABLE cuisines CHANGE COLUMN status status ENUM('active', 'inactive') NOT NULL DEFAULT 'inactive'");

        DB::statement("ALTER TABLE categories CHANGE COLUMN status status ENUM('active', 'inactive') NOT NULL DEFAULT 'inactive'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE recipes CHANGE COLUMN status status ENUM('active', 'inactive', 'pending') NOT NULL DEFAULT 'pending'");

        DB::statement("ALTER TABLE cuisines CHANGE COLUMN status status ENUM('active', 'inactive', 'pending') NOT NULL DEFAULT 'pending'");

        DB::statement("ALTER TABLE categories CHANGE COLUMN status status ENUM('active', 'inactive', 'pending') NOT NULL DEFAULT 'pending'");
    }
};

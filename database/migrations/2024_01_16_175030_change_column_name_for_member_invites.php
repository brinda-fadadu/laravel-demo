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
        Schema::table('member_invites', function (Blueprint $table) {
            $table->tinyInteger('account_type')->default(3)->after('email');
            $table->dropColumn('role_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('account_type')->nullable()->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_invites', function (Blueprint $table) {
            $table->integer('role_id');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('account_type');
        });
    }
};

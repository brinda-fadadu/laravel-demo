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
            $table->dropColumn(['amount_for_month','amount_for_year']);
            $table->string('recurring_total')->nullable()->after('payment_for');
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
            $table->dropColumn(['recurring_total']);
            $table->string('amount_for_month')->after('payment_for')->nullable();
            $table->string('amount_for_year')->after('amount_for_month')->nullable();
        });
    }
};

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
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->string('payment_for')->nullable()->after('transaction_json');
            $table->unsignedBigInteger('subscription_id')->change()->nullable();
            $table->unsignedBigInteger('wp_subscription_id')->after('subscription_id')->nullable();
            $table->unsignedBigInteger('quantity')->after('wp_subscription_id')->default(1);
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('wp_id')->nullable()->after('user_id');
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
            $table->dropColumn(['payment_for', 'wp_subscription_id','quantity']);
            $table->unsignedBigInteger('subscription_id')->change();
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('wp_id');
        });
    }
};

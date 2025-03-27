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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('uuid',36);
            $table->string('unique_id')->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('phone_number')->nullable();
            $table->text('profile_url')->nullable();
            $table->text('profile_img')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('stripe_acct_id')->nullable();
            $table->string('stripe_cust_id')->nullable();
            $table->boolean('is_subscription_recurring')->default(false);
            $table->integer('remaining_kits')->nullable();
            $table->rememberToken();
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

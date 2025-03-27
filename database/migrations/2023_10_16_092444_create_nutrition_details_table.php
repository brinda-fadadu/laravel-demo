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
        Schema::create('nutrition_details', function (Blueprint $table) {
            $table->id();
            $table->char('uuid',36);
            $table->unsignedBigInteger('user_id');
            $table->text('description')->nullable();
            $table->text('certificate_url')->nullable();
            $table->text('certificate_path')->nullable();
            $table->string('total_experience', 255);
            $table->float('package_amount')->nullable();
            $table->float('package_percentage')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
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
        Schema::dropIfExists('nutrition_details');
    }
};

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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->char('uuid',36);
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->enum('type', ['public', 'private'])->default('public');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('prep_time')->nullable();
            $table->string('serving_time')->nullable();
            $table->string('ingredients')->nullable();
            $table->string('instructions')->nullable();
            $table->text('notes')->nullable();
            $table->text('steps')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
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
        Schema::dropIfExists('recipes');
    }
};

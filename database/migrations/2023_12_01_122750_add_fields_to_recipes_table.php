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
        Schema::table('recipes', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
            $table->string('total_time')->nullable()->after('prep_time');
            $table->string('program')->nullable()->after('total_time');
            $table->dropColumn(['ingredients', 'instructions', 'steps']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn(['description','total_time','program']);
            $table->string('ingredients')->nullable()->after('serving_people');
            $table->string('instructions')->nullable()->after('ingredients');
            $table->text('steps')->nullable()->after('instructions');
        });
    }
};

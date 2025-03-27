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
        Schema::table('cuisines', function (Blueprint $table) {
            $table->text('description')->after('name')->nullable();
            $table->text('file_url')->after('description')->nullable();
            $table->text('file_path')->after('file_url')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->after('file_path')->default('pending');
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
        Schema::table('cuisines', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['description','file_url','file_path','status']);
        });
    }
};

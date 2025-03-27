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
        Schema::table('groceries', function (Blueprint $table) {
            $table->dropColumn(['description', 'status']); // Remove the columns
            $table->string('unit')->nullable()->after('name'); // Add new column 'unit'
            $table->string('amount')->nullable()->after('unit'); // Add new column 'amount'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groceries', function (Blueprint $table) {
            $table->text('description')->nullable(); // Reverse removing 'description'
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending'); // Reverse removing 'status'
            $table->dropColumn(['unit', 'amount']); // Reverse adding 'unit' and 'amount'
        });
    }
};

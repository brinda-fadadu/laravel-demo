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
        Schema::table('dietary_preferences', function (Blueprint $table) {
            if (!Schema::hasColumn('dietary_preferences', 'status')) {
                $table->enum('status', ['active', 'inactive','pending'])->default('active')->after('description');
            }
        });
        Schema::table('dietary_restrictions', function (Blueprint $table) {
            if (!Schema::hasColumn('dietary_restrictions', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('dietary_restrictions', 'status')) {
                $table->enum('status', ['active', 'inactive','pending'])->default('active')->after('image');
            }
        });
        Schema::table('breakfasts', function (Blueprint $table) {
            if (!Schema::hasColumn('breakfasts', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('breakfasts', 'status')) {
                $table->enum('status', ['active', 'inactive','pending'])->default('active')->after('image');
            }
        });
        Schema::table('desserts', function (Blueprint $table) {
            if (!Schema::hasColumn('desserts', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('desserts', 'status')) {
                $table->enum('status', ['active', 'inactive','pending'])->default('active')->after('image');
            }
        });
        Schema::table('heat_levels', function (Blueprint $table) {
            if (!Schema::hasColumn('heat_levels', 'status')) {
                $table->enum('status', ['active', 'inactive','pending'])->default('active')->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dietary_preferences', function (Blueprint $table) {
            if (Schema::hasColumn('dietary_preferences', 'status')) {
                $table->dropColumn('status');
            }
        });
        Schema::table('dietary_restrictions', function (Blueprint $table) {
            if (Schema::hasColumn('dietary_restrictions', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('dietary_restrictions', 'status')) {
                $table->dropColumn('status');
            }
        });
        Schema::table('breakfasts', function (Blueprint $table) {
            if (Schema::hasColumn('breakfasts', 'status')) {
                $table->dropColumn('status');
            }
        });
        Schema::table('desserts', function (Blueprint $table) {
            if (Schema::hasColumn('desserts', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('desserts', 'status')) {
                $table->dropColumn('status');
            }
        });
        Schema::table('heat_levels', function (Blueprint $table) {
            if (Schema::hasColumn('heat_levels', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};

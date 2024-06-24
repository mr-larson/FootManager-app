<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('coach')->nullable()->after('description');
            $table->string('formation')->nullable()->after('coach');
            $table->string('captain')->nullable()->after('formation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('coach');
            $table->dropColumn('formation');
            $table->dropColumn('captain');
        });
    }
};

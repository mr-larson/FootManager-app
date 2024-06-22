<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('soccer_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id_home')->constrained('teams')->onDelete('cascade');
            $table->foreignId('team_id_away')->constrained('teams')->onDelete('cascade');
            $table->integer('score_team_home')->nullable();
            $table->integer('score_team_away')->nullable();
            $table->timestamp('date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soccer_matches');
    }
};

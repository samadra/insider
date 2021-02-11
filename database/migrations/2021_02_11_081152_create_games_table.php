<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home_team')->unsigned()->index();
            $table->integer('away_team')->unsigned()->index();
            $table->tinyInteger('home_score');
            $table->tinyInteger('away_score');
            $table->tinyInteger('week');
            $table->timestamps();

            $table->foreign('home_team')->references('id')->on('teams');
            $table->foreign('away_team')->references('id')->on('teams');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}

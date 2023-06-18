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
        Schema::create('en_details', function (Blueprint $table) {
            $table->id();
            $table->string('animeId');
            $table->string('animeTitle');
            $table->string('type');
            $table->string('releasedDate');
            $table->string('status');
            $table->string('genres');
            $table->string('otherNames');
            $table->longText('synopsis');
            $table->string('animeImg');
            $table->string('totalEpisodes');
            $table->longText('episodesList'); 
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_en');
    }
};

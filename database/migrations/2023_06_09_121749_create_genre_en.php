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
        Schema::create('genre_ens', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->string('genre');
            $table->string('animeId');
            $table->string('animeTitle');
            $table->string('animeImg');
            $table->string('releasedDate');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_en');
    }
};

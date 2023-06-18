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
        Schema::create('top_airs', function (Blueprint $table) {
            $table->id();
            $table->integer('page');
            $table->string('animeId');
            $table->string('animeTitle');
            $table->string('animeImg');
            $table->string('latestEp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('top_airs');
    }
};

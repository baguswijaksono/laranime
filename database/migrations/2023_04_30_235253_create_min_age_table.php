<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('minAge', function (Blueprint $table) {
            $table->id();
            $table->integer('animeId');
            $table->integer('minAge');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('minAge');
    }
    
};

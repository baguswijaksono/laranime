<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('min_ages', function (Blueprint $table) {
            $table->id();
            $table->string('animeId');
            $table->integer('minAge');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('min_ages');
    }
    
};

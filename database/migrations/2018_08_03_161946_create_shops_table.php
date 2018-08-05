<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



class CreateShopsTable extends Migration
{
    
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('desc');
            $table->timestamps();

        });
    }

   
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}

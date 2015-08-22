<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function(Blueprint $table){
          $table->increments('id');
          $table->string('letter');
          $table->string('name')
            ->unique();
          $table->string('transliteration');
          $table->string('asciitranslit');

          /** Timestamps **/
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('letters');
    }
}

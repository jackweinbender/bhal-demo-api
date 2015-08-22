<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('definitions', function(Blueprint $table){

          $table->increments('id');
          $table->string('title');
          $table->text('body');
          $table->string('content');

          // Relational bits
          $table->integer('lemma_id')->unsigned();
          $table->foreign('lemma_id')->references('id')->on('lemmas');
          // Timestamps
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
        Schema::drop('definitions');
    }
}

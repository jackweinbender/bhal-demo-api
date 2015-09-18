<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCognatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('cognates', function(Blueprint $table){

          $table->increments('id');
          $table->text('name')
            ->nullable();
          $table->text('abbr')
            ->nullable();
          $table->text('slug')
            ->nullable();
          /* Relational bits */
          $table->integer('root_id')->unsigned();
          $table->foreign('root_id')->references('id')->on('root');
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
        Schema::drop('cognates');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtymologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('etymologies', function(Blueprint $table){

          $table->increments('id');
          $table->text('discussion')
            ->nullable()
            ->default(NULL);

          /* Relational bits */
          $table->integer('root_id')->unsigned();
          $table->foreign('root_id')->references('id')->on('roots');
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
        Schema::drop('etymologies');
    }
}

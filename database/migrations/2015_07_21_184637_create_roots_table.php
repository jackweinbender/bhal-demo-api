<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRootsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roots', function(Blueprint $table){

          $table->increments('id');
          $table->string('root');
          // $table->string('rootSlug')
          //   ->unique();
          // $table->integer('homonymNumber')
          //   ->default(1)
          //   ->unsigned();
          // $table->string('rootDisplay');
          $table->string('letter_name');

          /* Relational bits */
          $table->foreign('letter_name')->references('name')->on('letters');
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
        Schema::drop('roots');
    }
}

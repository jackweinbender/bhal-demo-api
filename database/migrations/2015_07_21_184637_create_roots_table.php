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
          $table->string('rootSlug')
            ->unique()
            ->nullable()
            ->default(NULL);
          $table->integer('homonymNumber')
            ->unsigned()
            ->default(1);
          $table->string('rootDisplay')
            ->nullable()
            ->default(NULL);
          $table->string('letter_name')
            ->nullable()
            ->default(NULL);

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

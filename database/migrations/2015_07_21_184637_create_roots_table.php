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
          $table->string('root')
            ->nullable();
          $table->string('root_slug')
            ->nullable()
            ->unique()
            ->default(NULL);
          $table->integer('homonym_number')
            ->unsigned()
            ->nullable()
            ->default(NULL);
          $table->string('display')
            ->nullable()
            ->default(NULL);
          $table->string('basic_definition')
            ->nullable()
            ->default(NULL);
          $table->string('historical_root')
            ->nullable()
            ->default(NULL);

          /* Relational bits */
          $table->integer('letter_id')
            ->unsigned()
            ->nullable();
          $table->foreign('letter_id')->references('id')->on('letters');
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

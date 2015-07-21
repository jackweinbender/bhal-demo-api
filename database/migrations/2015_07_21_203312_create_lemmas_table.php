<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLemmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lemmas', function(Blueprint $table){

          $table->increments('id');
          $table->integer('entry');
          $table->string('word');
          $table->string('root')
            ->nullable();
          $table->string('homonymNumber')
            ->nullable();
          $table->integer('strongs')
            ->nullable()
            ->default(NULL);
          $table->integer('page');
          $table->string('language');
          $table->string('speech')
            ->nullable();
          $table->string('basicDef')
            ->nullable();
          $table->string('historicalForm')
            ->nullable();
          $table->string('rootFamily')
            ->nullable();
          $table->string('pattern')
            ->nullable();
          // MetaData
          $table->boolean('isReconstructed')
            ->default(FALSE);
          $table->boolean('correctedTsade')
            ->default(FALSE);
          $table->boolean('isXref')
            ->default(FALSE);
          $table->boolean('isRootEntry')
            ->default(FALSE);
          $table->string('rootAssignNote')
            ->nullable()
            ->default(NULL);

          // Relational bits
          $table->string('letter_name');
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
        Schema::drop('lemmas');
    }
}

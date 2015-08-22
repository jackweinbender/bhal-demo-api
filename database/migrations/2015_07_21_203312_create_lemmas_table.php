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
          /**
           * Properties
           */
          $table->increments('id');
          $table->integer('entry')
            ->unsigned()
            ->nullable();
          $table->string('word');
          $table->string('homonymNumber')
            ->nullable();
          $table->integer('strongs')
            ->unsigned()
            ->nullable();
          $table->integer('page')
            ->unsigned()
            ->nullable();
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
          /**
           * MetaData
           */
          $table->boolean('isReconstructed')
            ->default(FALSE);
          $table->boolean('correctedTsade')
            ->default(FALSE);
          $table->boolean('isXref')
            ->default(FALSE);
          $table->boolean('isRootEntry')
            ->default(FALSE);
          $table->string('rootAssignNote')
            ->nullable();
          /**
           * Relational bits
           */
          // App\Letter
          $table->string('letter_name')->nullable();
          $table->foreign('letter_name')->references('name')->on('letters');
          // App\Root
          $table->integer('root_id')->unsigned()->nullable();
          $table->foreign('root_id')->references('id')->on('roots');
          /**
           * Timestamps
           */
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

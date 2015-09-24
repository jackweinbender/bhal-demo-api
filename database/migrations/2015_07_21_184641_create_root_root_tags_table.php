<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRootRootTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('root_root_tag', function(Blueprint $table){
        $table->integer('root_tag_id')
          ->unsigned();
        $table->integer('root_id')
          ->unsigned();
        $table->foreign('root_tag_id')->references('id')->on('root_tags');
        $table->foreign('root_id')->references('id')->on('roots');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('root_root_tag');
    }
}

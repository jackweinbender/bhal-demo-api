<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call( 'LettersTableSeederProduction' );

        $letters = App\Letter::get();

        $letters->each(function($letter){
          $roots = factory(App\Root::class, 10)->make();
          $letter->roots()->saveMany($roots);
        });

        $tags = factory(App\RootTag::class, 10)->create();

        $roots = App\Root::get();
        $roots->each(function($root){
          $numTags = rand(0, 4);

          for ($i = 0; $i < $numTags; $i++) {
              $tagId = rand(1, 10);
              $addTag = App\RootTag::find($tagId);
              $root->tags()->attach($addTag);
          }

          $root->save();
        });



        Model::reguard();
    }
}

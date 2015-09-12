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





        Model::reguard();
    }
}

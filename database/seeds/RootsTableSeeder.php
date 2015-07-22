<?php

use Illuminate\Database\Seeder;
use App\Root;
use App\Letter;

class RootsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = storage_path('seeds/roots.json');
        $raw = file_get_contents($input);
        $roots = json_decode($raw);

        foreach ($roots->roots as $letter_key => $root_array) {

          // Get the proper App\Letter for this relationship
          $letter = Letter::get()->where("name", $letter_key)->first();
            $letter->toArray();

          // Create a new array to store newly created roots
          $new_roots = [];

          // Create a new App\Root for each object in the Array
          foreach ($root_array as $root) {
            $new = new Root;
            $new->letter_name = $letter_key;
            $new->root = $root;

            // Save new App\Root to the DB
            $new->save();

            // Add the new App\Root to the $new_root Array
            $new_roots[] = $new;
          }

          // Save the new roots to the App\Letter
          $letter->roots()->saveMany($new_roots);

        }
    }
}

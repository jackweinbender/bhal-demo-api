<?php

use Illuminate\Database\Seeder;
use App\Root;
use App\Letter;
use App\Etymology;

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
          // Create a new array to store newly created roots
          $new_roots = [];

          // Create a new App\Root for each object in the Array
          foreach ($root_array as $root) {

            // Instantiate a new Root
            $new = new Root;
            // Assign properties
            $new->display = $root;

            // Add the new App\Root to the $new_root Array
            $new_roots[] = $new;
          }

          // Save the new roots to the App\Letter
          print_r("Batch Saving $letter->name ... ");
          $letter->roots()->saveMany($new_roots);
          print_r("completed\n");
        }
    }
}

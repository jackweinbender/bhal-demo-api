<?php

use Illuminate\Database\Seeder;
use App\Root;

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

        foreach ($roots->roots as $letter => $root_array) {
          foreach ($root_array as $root) {
            $new = new Root;
            $new->letter_name = $letter;
            $new->root = $root;

            $new->save();
          }
        }
    }
}

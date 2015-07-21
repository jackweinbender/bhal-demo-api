<?php

use Illuminate\Database\Seeder;
use App\Letter;
use App\Lemma;

class LemmasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Sets input file
      $input = storage_path('seeds/content_dump.json');

      // Retrieves the raw response from JSON file
      $raw = file_get_contents($input);

      ini_set('memory_limit', '256M');
      // encodes the JSON response into a PHP object
      $entries = json_decode($raw);

      foreach ($entries as $entry) {

        $letter = Letter::get()->where('letter', $entry->header->letter)->first();

        $new = new Lemma;

        $new->word      = $entry->header->word;
        $new->entry     = $entry->header->entry;
        $new->strongs   = $entry->header->strongs;
        $new->page      = $entry->header->page;
        $new->language  = $entry->header->language;

        $new->letter_name = $letter->name;

        $new->save();
      }
    }
}

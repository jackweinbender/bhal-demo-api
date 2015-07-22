<?php

use Illuminate\Database\Seeder;
use App\Letter;
use App\Lemma;
use App\Definition;

class LemmasAndDefinitionsTableSeeder extends Seeder
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

        // Get the right letter object for relationship
        $letter = Letter::get()->where('letter', $entry->header->letter)->first();

        // Build the Lemma object, save as $lemma
        $lemma = $this->makeLemma($entry, $letter);

        // Build the Definition objects
        foreach ($entry->definitions as $definition) {

          $def = $this->makeDefinition($definition, $lemma);

        }

      }
    }

    /**
     * Creates a Lemma object, assigns properties, and saves
     *
     * @param  Entry JSON object $entry
     * @param  App\Letter $letter
     * @return App\Lemma a new Lemma object
     */
    protected function makeLemma(stdClass $entry, App\Letter $letter){
      $new = new Lemma;

      $new->word      = $entry->header->word;
      $new->entry     = $entry->header->entry;
      $new->strongs   = $entry->header->strongs;
      $new->page      = $entry->header->page;
      $new->language  = $entry->header->language;

      $new->letter_name = $letter->name;

      $new->save();

      return $new;
    }

    /**
     * Creates a Lemma object, assigns properties, and saves
     *
     * @param  Object $definition
     * @param  App\Lemma $lemma
     * @return App\Definition
     */
    private function makeDefinition(stdClass $definition, App\Lemma $lemma){

      $new = new Definition;

      $new->title = $definition->title;
      $new->body = $definition->body;
      $new->content = $definition->content;
      $new->lemma_id = $lemma->id;

      $new->save();

      return $new;

    }

}

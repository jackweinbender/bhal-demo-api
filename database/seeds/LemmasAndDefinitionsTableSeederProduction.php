<?php

use Illuminate\Database\Seeder;
use App\Letter;
use App\Lemma;
use App\Definition;

class LemmasAndDefinitionsTableSeederProduction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Increase memory for this bit
      ini_set('memory_limit', '256M');

      // Set input file
      $input = storage_path('seeds/content_dump.json');

      // Retrieve the raw response from JSON file
      $raw = file_get_contents($input);

      // Encode the JSON response into a PHP object
      $entries = json_decode($raw);

      foreach ($entries as $entry) {

        // Get the right letter object for relationship
        $letter = Letter::get()->where('letter', $entry->header->letter)->first();

        // Array to hold new App\Definitnion for saveMany
        $new_definitions = [];

        // Build the Lemma object, save as $lemma
        print_r("- LEMMA -\n- ");
        $lemma = $this->makeLemma($entry, $letter);

        // Build the Definition objects
        foreach ($entry->definitions as $definition) {

          // Make the new App\Definition; Returns new App\Definitnion
          print_r(">");
          $def = $this->makeDefinition($definition, $lemma);

          // Add new $def to the $new_definitions Array
          $new_definitions[] = $def;

        }
        // Save the new App\Lemma to the associated App\Letter
        $letter->lemmas()->save($lemma);
        print_r("\n- LEMMA SAVED -\n");
        // Bulk-assign the App\Definition Array to the associated App\Lemma

        print_r("- BATCH SAVING DEFINITIONS ... ");
        $lemma->definitions()->saveMany($new_definitions);
        print_r("DONE\n");


      }

    }

    /**
     * Creates a Lemma object, assigns properties
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

      return $new;
    }

    /**
     * Creates a Lemma object, assigns properties
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

      return $new;

    }

}

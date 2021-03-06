<?php

use Illuminate\Database\Seeder;
use App\Letter;

class LettersTableSeederProduction extends Seeder
{
    /**
     * Seeds the 'Letters' table with the current API data from Heroku
     *
     * @return void
     */
    public function run()
    {
        // Sets input file
        $input = storage_path('seeds/letters.json');

        // Retrieves the raw response from JSON file
        $raw = file_get_contents($input);

        // encodes the JSON response into a PHP object
        $letters = json_decode($raw);

        // Creates a record in teh Letters table for each
        // letter retrieved; typecast as an array for Eloquent
        print_r("Writing ");
        foreach ($letters->letters as $letter) {
          print_r(" . ");
          Letter::create((array) $letter);

        }
        print_r("done\n");



    }
}

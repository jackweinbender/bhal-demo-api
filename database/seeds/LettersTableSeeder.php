<?php

use Illuminate\Database\Seeder;
use App\Letter;

class LettersTableSeeder extends Seeder
{
    /**
     * Seeds the 'Letters' table with the current API data from Heroku
     *
     * @return void
     */
    public function run()
    {
        // Retrieves the raw response from teh API endpoint
        $raw = file_get_contents('http://bhal-api.semitic.us/api/v1/letters');

        // encodes the JSON response into a PHP object
        $letters = json_decode($raw);

        // Creates a record in teh Letters table for each
        // letter retrieved; typecast as an array for Eloquent
        foreach ($letters->letters as $letter) {
          // Reassign "_id" to "id";
          $letter->id = $letter->_id;
          unset($letter->_id);

          Letter::create((array) $letter);
        }



    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProductionSeeder extends Seeder
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
        $this->call( 'RootsTableSeederProduction' );
        $this->call( 'LemmasAndDefinitionsTableSeederProduction' );

        Model::reguard();
    }
}

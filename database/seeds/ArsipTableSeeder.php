<?php

use Illuminate\Database\Seeder;

class ArsipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    	
        factory(App\Arsip::class, 50)->create();
    }
}

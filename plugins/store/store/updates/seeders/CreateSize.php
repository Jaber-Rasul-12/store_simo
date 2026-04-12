<?php 

namespace Store\Store\Updates\Seeders;

use Seeder;
use DB ;

class CreateSize extends Seeder
{
    public function run()
    {
        DB::table('store_store_sizes')->insert([
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
            ['name' => 'XL'],
            ['name' => 'XXL'],
            ['name' => 'XXXL'],
            ['name' => 'XXXXL'],
            ['name' => 'XXXXXL'],
        ]);
    }
}   

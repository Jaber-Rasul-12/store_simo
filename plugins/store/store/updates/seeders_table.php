<?php 

namespace Store\Store\Updates;


use Seeder;
use Model;
use Store\Store\Updates\Seeders\CreateSize;
use Store\Store\Updates\Seeders\SeedBrandsTable;
use Store\Store\Updates\Seeders\SeedCategoriesTable;
use Store\Store\Updates\Seeders\SeedColorsTable;
use Store\Store\Updates\Seeders\SeedProductTaxesTable;
use Store\Store\Updates\Seeders\SeedReturnPoliciesTable;

class SeedersTable extends Seeder 

{

    public function run()

    {


        Model::unguard();
        $this->call(CreateSize::class);
        $this->call(SeedCategoriesTable::class);
        $this->call(SeedBrandsTable::class);
        $this->call(SeedColorsTable::class);
        $this->call(SeedReturnPoliciesTable::class);
        $this->call(SeedProductTaxesTable::class);

        



    }
}
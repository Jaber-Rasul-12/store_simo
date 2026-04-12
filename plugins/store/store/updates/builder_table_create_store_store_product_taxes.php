<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreProductTaxes extends Migration
{
    public function up()
    {
        Schema::create('store_store_product_taxes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->double('price', 10, 0);
            $table->boolean('status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_product_taxes');
    }
}

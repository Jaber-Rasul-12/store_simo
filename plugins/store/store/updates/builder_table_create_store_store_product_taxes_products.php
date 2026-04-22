<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreProductTaxesProducts extends Migration
{
    public function up()
    {
        Schema::create('store_store_product_taxes_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('product_taxe_id');
            $table->unsignedInteger('product_id');
            $table->primary(['product_taxe_id','product_id']);
            $table->foreign('product_taxe_id')
                ->references('id')
                ->on('store_store_product_taxes')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('store_store_products')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_product_taxes_products');
    }
}

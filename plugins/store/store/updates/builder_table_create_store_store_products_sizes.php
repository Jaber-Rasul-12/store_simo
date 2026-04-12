<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreProductsSizes extends Migration
{
    public function up()
    {
        Schema::create('store_store_products_sizes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('size_id')->unsigned();
            $table->primary(['product_id','size_id']);
            $table->foreign('product_id')
                ->references('id')
                ->on('store_store_products')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('size_id')
                ->references('id')
                ->on('store_store_sizes')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_products_sizes');
    }
}

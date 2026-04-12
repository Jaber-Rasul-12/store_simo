<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreProductsColors extends Migration
{
    public function up()
    {
        Schema::create('store_store_products_colors', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('color_id')->unsigned();
            $table->primary(['product_id','color_id']);

            $table->foreign('product_id')
                ->references('id')
                ->on('store_store_products')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('color_id')
                ->references('id')
                ->on('store_store_colors')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_products_colors');
    }
}

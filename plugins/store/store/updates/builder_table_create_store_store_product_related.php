<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreProductRelated extends Migration
{
    public function up()
    {
        Schema::create('store_store_product_related', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('product_id')->unsigned();
            $table->integer('related_product_id')->unsigned();
            $table->primary(['product_id','related_product_id']);
                    $table->foreign('product_id')
                    ->references('id')
                    ->on('store_store_products')
                    ->onDelete('cascade')->onUpdate('cascade');
                    $table->foreign('related_product_id')
                    ->references('id')
                    ->on('store_store_products')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_product_related');
    }
}

<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreProductsReturnPolicies extends Migration
{
    public function up()
    {
        Schema::create('store_store_products_return_policies', function($table)
        {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('return_policy_id');
            $table->primary(['product_id','return_policy_id']);
            $table->foreign('return_policy_id')
                ->references('id')
                ->on('store_store_return_policies')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('store_store_products')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_products_return_policies');
    }
}

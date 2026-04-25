<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreCategoriesProducts extends Migration
{
    public function up()
    {
        Schema::create('store_store_categories_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('subcategory_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('store_store_categories')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('store_store_categories')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subcategory_id')
                ->references('id')
                ->on('store_store_subcategories')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('store_store_products')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_categories_products');
    }
}

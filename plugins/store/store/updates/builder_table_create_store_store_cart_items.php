<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreCartItems extends Migration
{
    public function up()
    {
        Schema::create('store_store_cart_items', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('promotion_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->double('qty', 10, 0);
            $table->double('price', 10, 0);
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('size_id');
            $table->unsignedInteger('color_id');

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('color_id')
                ->references('id')
                ->on('store_store_colors')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('size_id')
                ->references('id')
                ->on('store_store_sizes')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('product_id')
                ->references('id')
                ->on('store_store_products')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cart_id')
                ->references('id')
                ->on('store_store_carts')
                ->onDelete('cascade')->onUpdate('cascade');  
            $table->foreign('promotion_id')
                ->references('id')
                ->on('store_store_promotions')
                ->onDelete('cascade')->onUpdate('cascade');  
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_cart_items');
    }
}

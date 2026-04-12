<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStorePrices extends Migration
{
    public function up()
    {
        Schema::create('store_store_prices', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->double('price', 10, 0);
            $table->bigInteger('product_id')->unsigned();
            $table->boolean('status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('product_id')
                ->references('id')
                ->on('store_store_products')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_prices');
    }
}

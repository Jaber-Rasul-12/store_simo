<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreInputProducts extends Migration
{
    public function up()
    {
        Schema::create('store_store_input_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->string('notes')->nullable();
            $table->double('qty', 10, 0);
            $table->bigInteger('backend_user_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('backend_user_id')
                    ->references('id')
                    ->on('backend_users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')
                    ->references('id')
                    ->on('store_store_products')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_input_products');
    }
}

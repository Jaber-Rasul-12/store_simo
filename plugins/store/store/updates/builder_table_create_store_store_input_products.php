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
            $table->unsignedInteger('product_id');
            $table->string('notes')->nullable();
            $table->double('qty', 10, 0);
            $table->unsignedInteger('backend_user_id');
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

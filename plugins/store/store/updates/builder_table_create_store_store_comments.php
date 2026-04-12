<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreComments extends Migration
{
    public function up()
    {
        Schema::create('store_store_comments', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->string('comment');
            $table->bigInteger('user_id');
            $table->double('rating', 10, 0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('product_id')
                ->references('id')
                ->on('store_store_products')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_comments');
    }
}

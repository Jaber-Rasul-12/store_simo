<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreSubcategories extends Migration
{
    public function up()
    {
        Schema::create('store_store_subcategories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('name');
            $table->text('description');
            $table->unsignedInteger('category_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('category_id')
                    ->references('id')
                    ->on('store_store_categories')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_subcategories');
    }
}

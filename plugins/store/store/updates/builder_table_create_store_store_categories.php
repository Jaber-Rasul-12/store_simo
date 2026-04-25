<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreCategories extends Migration
{
    public function up()
    {
        Schema::create('store_store_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('status')->default(0);
            $table->boolean('show_homepage')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_top')->default(0);
            $table->boolean('is_popular')->default(0);
            $table->boolean('is_trending')->default(0);
            $table->text('description')->nullable();
            $table->text('color');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_categories');
    }
}

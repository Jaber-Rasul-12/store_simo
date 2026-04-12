<?php namespace Store\Store\Updates;

use Schema;
use DB;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreSizes extends Migration
{
    public function up()
    {
        Schema::create('store_store_sizes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_sizes');
    }
}

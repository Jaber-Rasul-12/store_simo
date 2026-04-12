<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreContactMessages extends Migration
{
    public function up()
    {
        Schema::create('store_store_contact_messages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('full_name');
            $table->string('email');
            $table->string('subject');
            $table->text('message');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->boolean('is_read')->default(false);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_contact_messages');
    }
}

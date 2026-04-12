<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreCoupons extends Migration
{
    public function up()
    {
        Schema::create('store_store_coupons', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('full_name');
            $table->text('code')->unique();
            $table->boolean('status')->default(0);
            $table->text('information')->nullable();
            $table->double('percentage', 10, 0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_coupons');
    }
}

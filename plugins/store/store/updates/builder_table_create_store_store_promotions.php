<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStorePromotions extends Migration
{
    public function up()
    {
        Schema::create('store_store_promotions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('code');
            $table->double('discount_value', 10, 0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('description');
            $table->boolean('status');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('store_store_products')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        \DB::statement('DROP TABLE IF EXISTS store_store_promotions CASCADE');
        // Schema::drop('store_store_promotions');

        
    }
}

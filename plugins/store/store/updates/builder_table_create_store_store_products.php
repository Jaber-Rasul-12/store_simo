<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreProducts extends Migration
{
    public function up()
    {
        Schema::create('store_store_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('short_name');
            $table->string('slug');
            $table->bigInteger('backend_user_id')->unsigned();
            $table->bigInteger('merchant_id')->unsigned();

            $table->bigInteger('brand_id')->unsigned();
            $table->string('short_description');
            $table->text('long_description');
            $table->text('video_link');
            $table->double('qty' , 20,2);
            $table->boolean('is_featured');
            $table->boolean('new_product');
            $table->boolean('is_top');
            $table->boolean('is_best');
            $table->boolean('status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('merchant_id')
                ->references('id')
                ->on('store_store_merchants')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('backend_user_id')
                ->references('id')
                ->on('backend_users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('brand_id')
                ->references('id')
                ->on('store_store_brands')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        \DB::statement('DROP TABLE IF EXISTS store_store_products CASCADE');

        // Schema::dropIfExists('store_store_products');
    }
}

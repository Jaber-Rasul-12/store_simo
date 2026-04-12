<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreBrandRelated extends Migration
{
    public function up()
    {
        Schema::create('store_store_brand_related', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('brand_id')->unsigned();
            $table->integer('related_brand_id')->unsigned();
            $table->primary(['brand_id','related_brand_id']);
                        $table->foreign('brand_id')
                    ->references('id')
                    ->on('store_store_brands')
                    ->onDelete('cascade')->onUpdate('cascade');
                    $table->foreign('related_brand_id')
                    ->references('id')
                    ->on('store_store_brands')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_brand_related');
    }
}

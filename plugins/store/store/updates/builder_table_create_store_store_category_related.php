<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreCategoryRelated extends Migration
{
    public function up()
    {
        Schema::create('store_store_category_related', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('category_id')->unsigned();
            $table->integer('related_category_id')->unsigned();
            $table->primary(['category_id','related_category_id']);
                    $table->foreign('category_id')
                    ->references('id')
                    ->on('store_store_categories')
                    ->onDelete('cascade')->onUpdate('cascade');
                    $table->foreign('related_category_id')
                    ->references('id')
                    ->on('store_store_categories')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_category_related');
    }
}

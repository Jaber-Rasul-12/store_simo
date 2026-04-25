<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreSubCategoryRelated extends Migration
{
    public function up()
    {
        Schema::create('store_store_subcategory_related', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('subcategory_id')->unsigned();
            $table->integer('related_subcategory_id')->unsigned();
            $table->primary(['subcategory_id','related_subcategory_id']);
                    $table->foreign('subcategory_id')
                    ->references('id')
                    ->on('store_store_subcategories')
                    ->onDelete('cascade')->onUpdate('cascade');
                    $table->foreign('related_subcategory_id')
                    ->references('id')
                    ->on('store_store_subcategories')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_subcategory_related');
    }
}

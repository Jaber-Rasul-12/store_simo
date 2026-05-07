<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreTeams extends Migration
{
    public function up()
    {
        Schema::create('store_store_teams', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('full_name');
            $table->text('phone')->nullable();
            $table->text('fs_link')->nullable();
            $table->text('ins_link')->nullable();
            $table->text('tw_link')->nullable();
            $table->text('wh_number')->nullable();
            $table->text('address')->nullable();
            $table->string('job');
            $table->string('type');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_teams');
    }
}

<?php namespace Store\Store\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateStoreStoreCarts extends Migration
{
    public function up()
    {
        Schema::create('store_store_carts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('type');
            $table->bigInteger('wallet_id')->nullable()->unsigned();
            $table->bigInteger('coupon_id')->nullable()->unsigned();
            $table->string('notes')->nullable();
            $table->string('contacts')->nullable();
            $table->text('location_lat')->nullable();
            $table->text('location_lng')->nullable();
            $table->text('address')->nullable();

            


            $table->boolean('status');
            $table->decimal('total_price', 15, 2)->default(0);
            $table->decimal('total_promotions', 15, 2)->default(0);
            $table->decimal('final_price', 15, 2)->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');   
            $table->foreign('wallet_id')
                    ->references('id')
                    ->on('wallet_wallet_wallets')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('coupon_id')
                    ->references('id')
                    ->on('store_store_coupons')
                    ->onDelete('cascade')->onUpdate('cascade');   
            
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('store_store_carts');
    }
}

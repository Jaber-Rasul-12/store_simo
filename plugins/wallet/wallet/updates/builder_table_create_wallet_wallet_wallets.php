<?php namespace Wallet\Wallet\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateWalletWalletWallets extends Migration
{
    public function up()
    {
        Schema::create('wallet_wallet_wallets', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->text('public_id')->unique();
            $table->double('current_balance', 10, 0);
            $table->boolean('status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');   
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('wallet_wallet_wallets');
    }
}

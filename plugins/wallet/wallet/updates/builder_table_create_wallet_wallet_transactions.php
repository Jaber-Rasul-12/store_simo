<?php namespace Wallet\Wallet\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateWalletWalletTransactions extends Migration
{
    public function up()
    {
        Schema::create('wallet_wallet_transactions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('public_id')->unique();
            $table->unsignedInteger('wallet_id');  
            $table->double('amount', 10, 0);
            $table->string('description');
            $table->boolean('status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('wallet_id')
                    ->references('id')
                    ->on('wallet_wallet_wallets')
                    ->onDelete('cascade')->onUpdate('cascade');   
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('wallet_wallet_transactions');
    }
}

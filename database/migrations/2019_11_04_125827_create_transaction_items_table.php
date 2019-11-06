<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('borrow_date');
            $table->date('return_date');
          
            // item id
            $table->unSignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            //transaction id
            $table->unSignedBigInteger('transaction_id');
            $table->foreign('transaction_id')
                ->references('id')->on('transactions')
                ->onDelete('restrict')
                ->onUpdate('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_items');
    }
}

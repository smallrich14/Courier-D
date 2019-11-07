<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_number');
            $table->date('borrow_date');
            $table->date('return_date');
            $table->timestamps();


            // user_id
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            // status_id
            $table->unsignedBigInteger('status_id')->default(3);
            $table->foreign('status_id')
                  ->references('id')->on('statuses')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            // item id
            $table->unSignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

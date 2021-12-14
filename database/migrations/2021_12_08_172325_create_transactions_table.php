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
            $table->string('txn_id');
            $table->string('cargo_id');
            $table->string('cargo_name');
            $table->text('cargo_desc')->nullable();
            $table->integer('origin')->unsigned();
            $table->integer('destination')->unsigned();
            $table->string('bus');
            $table->string('sender_id');
            $table->string('sender_name');
            $table->string('sender_phone');
            $table->string('receiver_id');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->enum('status', ['received', 'shipping', 'reached', 'picked']);
            $table->timestamps();

            $table->index('txn_id');
            $table->foreign('origin')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('destination')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('bus')->references('bus_no')->on('buses')->onDelete('cascade');
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

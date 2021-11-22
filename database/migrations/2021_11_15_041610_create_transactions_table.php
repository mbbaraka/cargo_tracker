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
            $table->string('sender_id');
            $table->string('sender_name');
            $table->string('sender_phone');
            $table->string('receiver_id');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->enum('status', ['received', 'shipped', 'reached', 'picked']);
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
        Schema::dropIfExists('transactions');
    }
}

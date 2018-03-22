<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('payment_id')->unsigned();
            $table->uuid('user_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('user_payment_methods')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        DB::statement('ALTER TABLE payment_methods ALTER COLUMN id SET DEFAULT uuid_generate_v4();');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}

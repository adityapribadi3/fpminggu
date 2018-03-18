<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('user_id')->unsigned();
            $table->string('order_status');
            $table->date('order_date');
            $table->decimal('total_price');
            $table->date('payment_date');
            $table->decimal('payment_amount');
            $table->date('max_payment_date');
            $table->varchar('payment_status');
            $table->date('shipment_date');
            $table->varchar('shipment_tracking_number');

            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::statement('ALTER TABLE orders ALTER COLUMN id SET DEFAULT uuid_generate_v4();');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

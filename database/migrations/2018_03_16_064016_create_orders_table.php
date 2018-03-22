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
            $table->date('order_date')->default(date('Y-m-d'));
            $table->decimal('total_price',11,0);
            $table->date('payment_date')->nullable();
            $table->decimal('payment_amount')->nullable();
            $table->date('max_payment_date')->default(date('Y-m-d',strtotime('+1 day')));
            $table->string('payment_status')->nullable();
            $table->uuid('shipment_address_id')->unsigned();
            $table->date('shipment_date')->nullable();
            $table->string('shipment_status')->nullable();
            $table->string('shipment_tracking_number')->nullable();

            $table->foreign('shipment_address_id')->references('id')->on('user_addresses');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_items', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('shipment_id')->unsigned();
            $table->uuid('order_item_id')->unsigned();
            $table->timestamps();
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
        });
        DB::statement('ALTER TABLE shipment_items ALTER COLUMN id SET DEFAULT uuid_generate_v4();');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_items');
    }
}

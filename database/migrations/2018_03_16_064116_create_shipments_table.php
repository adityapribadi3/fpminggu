<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('order_id')->unsigned();
            $table->date('shipment_date');
            $table->string('additional_information');
            $table->string('shipment_tracking_number');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
        DB::statement('ALTER TABLE shipments ALTER COLUMN id SET DEFAULT uuid_generate_v4();');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}

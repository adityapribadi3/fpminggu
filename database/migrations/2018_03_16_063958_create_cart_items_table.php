<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table)
        {
            // $table->uuid('id');
            // $table->primary('id');
            $table->uuid('product_id')->unsigned()->primary();
            $table->uuid('cart_id')->unsigned()->primary();
            $table->integer('qty');
            $table->decimal('price',11,3);
            $table->uuid('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('product_id')->references('id')->on('product_details');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        DB::statement('ALTER TABLE cart_items ALTER COLUMN id SET DEFAULT uuid_generate_v4();');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}

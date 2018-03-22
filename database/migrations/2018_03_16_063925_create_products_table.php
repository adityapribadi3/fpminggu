<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('category_id')->unsigned();
            $table->string('product_name');
            $table->decimal('product_price',11);
            $table->string('product_description');
            $table->integer('product_qty');
            $table->integer('product_sold')->default('0');
            $table->text('product_img');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
        DB::statement('ALTER TABLE products ALTER COLUMN id SET DEFAULT uuid_generate_v4();');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

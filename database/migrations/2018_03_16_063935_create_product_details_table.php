<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->integer('product_id');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE product_details ALTER COLUMN id SET DEFAULT uuid_generate_v4();');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}

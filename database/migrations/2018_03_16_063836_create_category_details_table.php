<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_details', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('category_id')->unsigned();
            $table->string('key');
            $table->foreign('category_id')->references('id')->on('categories');
        });
        DB::statement('ALTER TABLE category_details ALTER COLUMN id SET DEFAULT uuid_generate_v4();');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_details');
    }
}

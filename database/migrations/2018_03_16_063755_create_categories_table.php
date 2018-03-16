<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table)
        {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('category_name')->unsigned();
            $table->string('parent_category_id')->unsigned();
            $table->timestamps();
            $table->foreign('category_name')->references('id')->on('categories')->onDelete('cascade');
        });
        DB::statement('ALTER TABLE categories ALTER COLUMN id SET DEFAULT uuid_generate_v4();');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

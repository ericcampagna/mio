<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mtr_pn');
            $table->unsignedBigInteger('product_line_id');
            $table->string('map_pn')->nullable();
            $table->string('status');
            $table->string('replaced_by')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('product_line_id')->references('id')->on('product-lines');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interchanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('interchangesPN');
            $table->string('mtr_PN');
            $table->unsignedBigInteger('part_id');
            $table->string('brand');
            $table->text('notes');
            $table->timestamps();
            $table->foreign('part_id')->references('id')->on('parts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interchanges');
    }
}

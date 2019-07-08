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
            $table->decimal('ci_pl', 17, 14);
            $table->decimal('ci_cum_pl',17, 14);
            $table->decimal('ci_total',17, 14);
            $table->decimal('vio_pl',17, 14);
            $table->decimal('cumm_vio', 17, 14);
            $table->decimal('per_vio_total', 17, 14);
            $table->string('pop_code');
            $table->string('plc');
            $table->integer('rank');
            $table->integer('vio_us')->nullable();
            $table->integer('vio_us_alt')->nullable();
            $table->integer('vio_mex')->nullable();
            $table->integer('vio_asian')->nullable();
            $table->integer('vio_domestic')->nullable();
            $table->integer('vio_european')->nullable();
            $table->integer('vio_0-3y')->nullable();
            $table->integer('vio_4-7y')->nullable();
            $table->integer('vio_8-11y')->nullable();
            $table->integer('vio_12y')->nullable();
            $table->integer('vio_canada')->nullable();
            $table->boolean('aval_us');
            $table->boolean('aval_ca');
            $table->boolean('aval_mex');
            $table->integer('min_yr');
            $table->integer('max_yr');
            $table->string('pop_app');
            $table->text('apps');
            $table->timestamps();
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

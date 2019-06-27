<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parts', function (Blueprint $table) {
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

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->dropColumn('mtr_pn_stripped');
            $table->renameColumn('minor_id', 'category_id');
            $table->dropColumn('ci_pl', 17, 14);
            $table->dropColumn('ci_cum_pl',17, 14);
            $table->dropColumn('ci_total',17, 14);
            $table->dropColumn('vio_pl',17, 14);
            $table->dropColumn('cumm_vio', 17, 14);
            $table->dropColumn('per_vio_total', 17, 14);
            $table->dropColumn('pop_code');
            $table->dropColumn('plc');
            $table->dropColumn('rank');
            $table->dropColumn('vio_us')->nullable();
            $table->dropColumn('vio_us_alt')->nullable();
            $table->dropColumn('vio_mex')->nullable();
            $table->dropColumn('vio_asian')->nullable();
            $table->dropColumn('vio_domestic')->nullable();
            $table->dropColumn('vio_european')->nullable();
            $table->dropColumn('vio_0-3y')->nullable();
            $table->dropColumn('vio_4-7y')->nullable();
            $table->dropColumn('vio_8-11y')->nullable();
            $table->dropColumn('vio_12y')->nullable();
            $table->dropColumn('vio_canada')->nullable();
            $table->dropColumn('aval_us');
            $table->dropColumn('aval_ca');
            $table->dropColumn('aval_mex');
            $table->dropColumn('min_yr');
            $table->dropColumn('max_yr');
            $table->dropColumn('pop_app');
            $table->dropColumn('apps');
        });
    }
}

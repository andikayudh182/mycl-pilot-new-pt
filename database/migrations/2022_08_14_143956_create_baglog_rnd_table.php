<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogRndTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(('baglog_rnd'))){
            Schema::create('baglog_rnd', function (Blueprint $table) {
                $table->id();
                $table->text('JenisResep');
                $table->date('TanggalBaglog');
                $table->integer('Jumlah');
                $table->text('Keterangan');
                $table->timestamps();
            });
        }  

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baglog_rnd');
    }
}

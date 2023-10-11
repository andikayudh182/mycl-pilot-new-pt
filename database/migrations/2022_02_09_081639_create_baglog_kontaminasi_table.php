<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogKontaminasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_kontaminasi', function (Blueprint $table) {
            $table->id();
            $table->string('KodeProduksi');
            $table->text('NoBaglog1');
            $table->text('NoBaglog2');
            $table->integer('JumlahKonta');
            $table->date('TanggalKonta');
            $table->text('Keterangan');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baglog_kontaminasi');
    }
}

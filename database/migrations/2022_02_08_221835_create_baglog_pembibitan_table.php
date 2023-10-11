<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogPembibitanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_pembibitan', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('KodeProduksi');
            $table->date('TanggalPengerjaan');
            $table->integer('Batch');
            $table->date('TanggalSterilisasi');
            $table->integer('JumlahBaglog');
            $table->text('Lokasi');
            $table->text('Kondisi');
            $table->integer('BibitTerpakai');
            $table->date('BatchBibitTerpakai');
            $table->integer('BibitReject');
            $table->date('BatchBibitDibuang');
            $table->date('TanggalCrushing');
            $table->integer('StatusCrushing');
            $table->date('TanggalPanen');
            $table->integer('StatusPanen');
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
        Schema::dropIfExists('baglog_pembibitan');
    }
}

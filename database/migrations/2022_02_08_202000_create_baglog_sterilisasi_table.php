<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogSterilisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_sterilisasi', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('TanggalPengerjaan');
            $table->time('JamMulai');
            $table->time('JamSelesai');
            $table->integer('JumlahBaglog');
            $table->text('Kondisi');
            $table->integer('JumlahBaglogReject')->nullable();
            $table->text('PenyebabReject')->nullable();
            $table->integer('mixing_id');
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
        Schema::dropIfExists('baglog_sterilisasi');
    }
}

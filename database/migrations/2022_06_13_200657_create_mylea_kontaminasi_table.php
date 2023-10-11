<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaKontaminasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mylea_kontaminasi')){
            Schema::create('mylea_kontaminasi', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->date('TanggalKontaminasi');
                $table->text('KPMylea');
                $table->text('KPBaglog');
                $table->integer('Jumlah');
                $table->text('NoBaglog');
                $table->text('NoBaglogBaru');
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
        Schema::dropIfExists('mylea_kontaminasi');
    }
}

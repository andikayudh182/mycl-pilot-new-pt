<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogCrushingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_crushing', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('KodeProduksi');
            $table->date('TanggalCrushing');
            $table->time('JamMulai');
            $table->time('JamSelesai');
            $table->text('KondisiBaglog');
            $table->integer('JumlahBaglogPutih');
            $table->integer('JumlahBaglogTidakTumbuh');
            $table->integer('JumlahBaglogTidakMerata');
            $table->integer('TotalBaglog');
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
        Schema::dropIfExists('baglog_crushing');
    }

}

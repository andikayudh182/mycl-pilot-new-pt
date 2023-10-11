<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogMixingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_mixing', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('TanggalPengerjaan');
            $table->integer('Batch');
            $table->time('JamMulai');
            $table->time('JamSelesai');
            $table->integer('JumlahBaglog');
            $table->integer('MCBaglog', 8, 3);
            $table->integer('resep_id');
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
        Schema::dropIfExists('baglog_mixing');
    }
}

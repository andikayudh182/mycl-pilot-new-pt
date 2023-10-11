<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogPengayakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_pengayakan', function (Blueprint $table) {
            $table->id();
            $table->date('TanggalPengerjaan');
            $table->text('NoKarung');
            $table->double('BeratAwal', 8, 2);
            $table->double('BeratAkhir', 8, 2);
            $table->integer('NoKontainer')->nullable();
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
        Schema::dropIfExists('baglog_pengayakan');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mylea_produksi')){
            Schema::create('mylea_produksi', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->text('KodeProduksi');
                $table->date('TanggalProduksi');
                $table->date('TanggalElus');
                $table->time('JamMulai');
                $table->time('JamSelesai');
                $table->integer('Jumlah');
                $table->integer('StatusPanen');
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
        Schema::dropIfExists('mylea_produksi');
    }
}

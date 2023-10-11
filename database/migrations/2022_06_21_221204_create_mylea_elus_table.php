<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaElusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(('mylea_elus'))){
            Schema::create('mylea_elus', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->date('TanggalElus');
                $table->text('KPMylea');
                $table->time('JamMulai');
                $table->time('JamSelesai');
                $table->integer('Jumlah');
                $table->text('Path');
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
        Schema::dropIfExists('mylea_elus');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaPanenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(('mylea_panen'))){
            Schema::create('mylea_panen', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->date('TanggalPanen');
                $table->text('KPMylea');
                $table->time('JamMulai');
                $table->time('JamSelesai');
                $table->integer('Jumlah');
                $table->text('JenisPanen');
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
        Schema::dropIfExists('mylea_panen');
    }
}

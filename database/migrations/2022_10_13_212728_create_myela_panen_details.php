<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyelaPanenDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(('mylea_panen_details'))){
            Schema::create('mylea_panen_details', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->integer('PanenID');
                $table->integer('KPBaglog');
                $table->integer('Jumlah');
                $table->text('NoBibit');
                $table->text('KondisiBaglog');
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
        Schema::dropIfExists('myela_panen_details');
    }
}

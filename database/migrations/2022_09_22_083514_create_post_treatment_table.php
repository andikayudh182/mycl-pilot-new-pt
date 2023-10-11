<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTreatmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(('post_treatment'))){
            Schema::create('post_treatment', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->date('Tanggal');
                $table->integer('PanenID');
                $table->time('JamMulai');
                $table->time('JamSelesai');
                $table->text("Proses");
                $table->integer('Jumlah');
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
        Schema::dropIfExists('post_treatment');
    }
}

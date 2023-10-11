<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTreatmentProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_treatment_proses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('PT_ID');
            $table->date('Tanggal');
            $table->time('JamMulai');
            $table->time('JamSelesai');
            $table->text('Proses');
            $table->integer('Jumlah');
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
        Schema::dropIfExists('post_treatment_proses');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePostTreatmentKerik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_treatment_kerik', function (Blueprint $table) {
            $table->id();
            $table->date('Tanggal');
            $table->integer('Jumlah');
            $table->integer('RejectBeforeKerik');
            $table->integer('RejectAfterKerik');
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
        Schema::dropIfExists('post_treatment_kerik');
    }
}

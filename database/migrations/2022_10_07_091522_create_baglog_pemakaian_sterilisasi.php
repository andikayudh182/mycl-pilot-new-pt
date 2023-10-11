<?php

use App\Models\Baglog\Sterilisasi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogPemakaianSterilisasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(('baglog_pemakaian_sterilisasi'))){
            Schema::create('baglog_pemakaian_sterilisasi', function (Blueprint $table) {
                $table->id();
                $table->integer('SterilisasiID');
                $table->integer('PembibitanID');
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
        Schema::dropIfExists('baglog_pemakaian_sterilisasi');
    }
}

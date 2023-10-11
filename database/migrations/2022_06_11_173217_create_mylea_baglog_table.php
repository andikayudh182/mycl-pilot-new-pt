<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyleaBaglogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('mylea_baglog')){
            Schema::create('mylea_baglog', function (Blueprint $table) {
                $table->id();
                $table->text('KPMylea');
                $table->text('KPBaglog');
                $table->integer('JumlahBaglog');
                $table->text('KondisiBaglog');
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
        Schema::dropIfExists('mylea_baglog');
    }
}

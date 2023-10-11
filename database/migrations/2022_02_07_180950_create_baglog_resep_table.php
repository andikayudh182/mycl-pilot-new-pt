<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaglogResepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baglog_resep', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('BeratBaglog');
            $table->integer('TotalBags');
            $table->double('SKayu', 8, 3);
            $table->double('MCSKayu', 8, 3);
            $table->string('NoKarungSKayu');
            $table->double('Tapioka', 8, 3);
            $table->double('MCTapioka', 8, 3);
            $table->double('Pollard', 8, 3);
            $table->double('MCPollard', 8, 3);
            $table->double('Kapur', 8, 3);
            $table->double('MCKapur', 8, 3);
            $table->double('Hickory', 8, 3);
            $table->double('MCHickory', 8, 3);
            $table->double('Air', 8, 3);
            $table->integer('Approval');
            $table->integer('Status');
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
        Schema::dropIfExists('baglog_resep');
    }
}

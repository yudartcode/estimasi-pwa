<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortpolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portpolio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('jenis');
            $table->string('bahan');
            $table->string('lengan');
            $table->string('biaya');
            $table->string('foto');
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
        Schema::dropIfExists('portpolio');
    }
}
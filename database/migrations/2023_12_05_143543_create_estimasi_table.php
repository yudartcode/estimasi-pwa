<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('tipe_estimasi', ['1', '2']);
            $table->unsignedBigInteger('kain_id');
            $table->foreign('kain_id')->references('id')->on('kain');
            $table->unsignedBigInteger('kemeja_id');
            $table->foreign('kemeja_id')->references('id')->on('kemeja');
            $table->unsignedBigInteger('ukuran_id');
            $table->foreign('ukuran_id')->references('id')->on('ukuran');
            $table->unsignedBigInteger('lengan_id');
            $table->foreign('lengan_id')->references('id')->on('lengan');
            $table->string('total_meter_kain');
            $table->string('total_biaya');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('status', ['diproses','diterima', 'ditolak']);
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
        Schema::dropIfExists('estimasi');
    }
}
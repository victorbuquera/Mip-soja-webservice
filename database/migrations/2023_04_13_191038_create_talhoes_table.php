<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talhoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->double('area');
            $table->string('coordenadas');
            $table->unsignedBigInteger('fazenda_id');
            $table->foreign('fazenda_id')->references('id')->on('fazendas')->onDelete('cascade');
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
        Schema::dropIfExists('talhoes');
    }
};

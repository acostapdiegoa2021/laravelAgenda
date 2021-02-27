<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lugar', 50)->nullable()->default(null);
            $table->string('nombre', 50)->nullable()->default(null);
            $table->dateTime('fechaCitaInicio')->nullable()->default(null);
            $table->dateTime('fechaCitaFin')->nullable()->default(null);
            $table->unsignedInteger('idUser')->nullable()->default(null);
            $table->unsignedSmallInteger('estado');
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
        Schema::dropIfExists('agendas');
    }
}

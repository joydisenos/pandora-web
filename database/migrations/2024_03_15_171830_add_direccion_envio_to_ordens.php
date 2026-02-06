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
        Schema::table('ordens', function (Blueprint $table) {
            $table->after('retiro' , function($table){
                $table->string('provincia_envio')->nullable();
                $table->string('distrito_envio')->nullable();
                $table->string('corregimiento_envio')->nullable();
                $table->string('barrio_envio')->nullable();
                $table->string('direccion_envio')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordens', function (Blueprint $table) {
            $table->dropColumn([
                'provincia_envio',
                'distrito_envio',
                'corregimiento_envio',
                'barrio_envio',
                'direccion_envio',
            ]);
        });
    }
};

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
        Schema::table('ubicacions', function (Blueprint $table) {
            $table->after('envio' , function($table){
                $table->integer('tipo_envio')->nullable();
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
        Schema::table('ubicacions', function (Blueprint $table) {
            $table->dropColumn('tipo_envio');
        });
    }
};

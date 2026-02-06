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
        Schema::table('productos', function (Blueprint $table) {
            $table->after('marca_id' , function($table){
                $table->integer('promociones')->default(0);
                $table->integer('productos_nuevos')->default(0);
                $table->integer('stock_vuelta')->default(0);
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
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn([ 'promociones','productos_nuevos','stock_vuelta']);
        });
    }
};

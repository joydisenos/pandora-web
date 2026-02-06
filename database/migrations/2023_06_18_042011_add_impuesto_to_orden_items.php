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
        Schema::table('orden_items', function (Blueprint $table) {
            $table->after('cantidad' , function($table){
                $table->float('impuesto')->default(0);
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
        Schema::table('orden_items', function (Blueprint $table) {
            $table->dropColumn('impuesto');
        });
    }
};

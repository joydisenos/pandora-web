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
            $table->after('tienda' , function($table){
                $table->integer('id_tipo_articulo')->default(0);
                $table->integer('flag_activo')->default(1);
                $table->float('cubicaje_x')->default(0);
                $table->float('cubicaje_y')->default(0);
                $table->float('cubicaje_z')->default(0);
                $table->text('garantia')->nullable();
                $table->string('color')->nullable();
                $table->string('talla')->nullable();
            });
            $table->after('categoria_id' , function($table){
                $table->integer('subcategoria_id')->nullable();
                $table->integer('marca_id')->nullable();
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
            $table->dropColumn(['id_tipo_articulo' , 
                                 'flag_activo' , 
                                 'cubicaje_x' , 
                                 'cubicaje_y' , 
                                 'cubicaje_z' , 
                                 'garantia' , 
                                 'color' , 
                                 'talla' , 
                                 'subcategoria_id' , 
                                 'marca_id' , 
            ]);
        });
    }
};

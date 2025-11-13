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
        Schema::table('detalle_reservas', function (Blueprint $table) {
            // Campo 'estado' (ej: 'C'=Confirmada, 'X'=Cancelada, 'M'=Modificada)
            $table->char('estado', 1)->default('C')->comment('C: Confirmada, X: Cancelada, M: Modificada');
            
            // Campo 'costo_penalidad' (double, nullable, default 0)
            $table->double('costo_penalidad', 10, 2)->nullable()->default(0);
            
            // Campo 'precio_penalidad' (double, nullable, default 0)
            $table->double('precio_penalidad', 10, 2)->nullable()->default(0);
        });
    }

    public function down()
    {
        Schema::table('detalle_reservas', function (Blueprint $table) {
            $table->dropColumn(['estado', 'costo_penalidad', 'precio_penalidad']);
        });
    }
};

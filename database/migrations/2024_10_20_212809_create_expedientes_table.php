<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->onDelete('cascade');
            $table->foreignId('inventario_id')
                ->nullable()
                ->constrained('inventarios')
                ->onDelete('set null');
            $table->string('equipo');
            $table->text('problema');
            $table->date('fecha');
            $table->text('observacion')->nullable();
            $table->decimal('costo', 10, 2)->default(0);
            $table->string('pdf')->nullable();
            $table->enum('estadoExpediente', [
                'Pendiente',
                'En Proceso',
                'Completado',
                'Cancelado'
            ])->default('Pendiente');
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};

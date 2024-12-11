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
        Schema::create('refaccions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediente_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('inventario_id')
                ->nullable()
                ->constrained('inventarios')
                ->onDelete('set null');
            $table->string('descripcion');
            $table->string('numero_parte')->nullable();
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refaccions');
    }
};
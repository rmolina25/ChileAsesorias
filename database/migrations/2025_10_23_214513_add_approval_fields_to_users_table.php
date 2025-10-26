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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('estado_aprobacion', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->json('documentos_subidos')->nullable();
            $table->timestamp('fecha_solicitud_aprobacion')->nullable();
            $table->timestamp('fecha_aprobacion')->nullable();
            $table->text('motivo_rechazo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['estado_aprobacion', 'documentos_subidos', 'fecha_solicitud_aprobacion', 'fecha_aprobacion', 'motivo_rechazo']);
        });
    }
};

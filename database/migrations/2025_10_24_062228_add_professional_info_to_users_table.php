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
            $table->json('especialidades')->nullable()->after('blog_url');
            $table->json('certificaciones')->nullable()->after('especialidades');
            $table->text('biografia_profesional')->nullable()->after('certificaciones');
            $table->integer('clientes_atendidos')->default(0)->after('biografia_profesional');
            $table->decimal('calificacion', 3, 1)->default(0.0)->after('clientes_atendidos');
            $table->integer('anos_experiencia')->default(0)->after('calificacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

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
            $table->string('telefono')->nullable()->after('email');
            $table->string('direccion')->nullable()->after('telefono');
            $table->string('ciudad')->nullable()->after('direccion');
            $table->date('fecha_nacimiento')->nullable()->after('ciudad');
            $table->enum('genero', ['masculino', 'femenino', 'otro'])->nullable()->after('fecha_nacimiento');
            $table->string('foto_perfil')->nullable()->after('genero');
            $table->string('username')->nullable()->unique()->after('foto_perfil');
            $table->boolean('acepta_terminos')->default(false)->after('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'telefono',
                'direccion',
                'ciudad',
                'fecha_nacimiento',
                'genero',
                'foto_perfil',
                'username',
                'acepta_terminos'
            ]);
        });
    }
};

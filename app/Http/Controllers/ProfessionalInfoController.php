<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfessionalInfoController extends Controller
{
    /**
     * Actualizar la información profesional del usuario
     */
    public function update(Request $request)
    {
        $request->validate([
            'especialidades' => 'nullable|array',
            'especialidades.*' => 'string|max:100',
            'certificaciones' => 'nullable|array',
            'certificaciones.*' => 'string|max:200',
            'biografia_profesional' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        // Procesar especialidades (convertir string separado por comas a array)
        $especialidades = [];
        if ($request->filled('especialidades')) {
            $especialidades = array_map('trim', explode(',', $request->especialidades[0]));
            $especialidades = array_filter($especialidades); // Eliminar elementos vacíos
        }
        
        // Procesar certificaciones (convertir string separado por comas a array)
        $certificaciones = [];
        if ($request->filled('certificaciones')) {
            $certificaciones = array_map('trim', explode(',', $request->certificaciones[0]));
            $certificaciones = array_filter($certificaciones); // Eliminar elementos vacíos
        }

        User::where('id', $user->id)->update([
            'especialidades' => !empty($especialidades) ? json_encode($especialidades) : null,
            'certificaciones' => !empty($certificaciones) ? json_encode($certificaciones) : null,
            'biografia_profesional' => $request->biografia_profesional,
        ]);

        return back()->with('professional_success', 'Información profesional actualizada correctamente.');
    }
}

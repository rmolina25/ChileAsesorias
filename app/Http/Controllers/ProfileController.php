<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Actualizar la foto de perfil del usuario
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto_perfil' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();
        
        // Eliminar la foto anterior si existe
        if ($user->foto_perfil && Storage::disk('public')->exists($user->foto_perfil)) {
            Storage::disk('public')->delete($user->foto_perfil);
        }

        // Guardar la nueva foto
        $fotoPerfilPath = $request->file('foto_perfil')->store('fotos_perfil', 'public');
        
        // Actualizar el usuario usando el modelo User
        User::where('id', $user->id)->update([
            'foto_perfil' => $fotoPerfilPath,
        ]);

        return back()->with('success', 'Foto de perfil actualizada correctamente.');
    }
}

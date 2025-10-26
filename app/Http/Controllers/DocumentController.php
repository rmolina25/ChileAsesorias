<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Subir documentos profesionales
     */
    public function upload(Request $request)
    {
        $request->validate([
            'titulo_profesional' => 'nullable|file|mimes:pdf|max:5120', // 5MB max
            'certificaciones' => 'nullable|file|mimes:pdf|max:5120',
            'cedula_profesional' => 'nullable|file|mimes:pdf|max:5120',
            'otros_documentos' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $user = Auth::user();
        $documentosSubidos = $user->documentos_subidos ?? [];
        $documentosGuardados = [];

        // Procesar cada tipo de documento
        $tiposDocumentos = [
            'titulo_profesional' => 'Título Profesional',
            'certificaciones' => 'Certificaciones',
            'cedula_profesional' => 'Cédula Profesional',
            'otros_documentos' => 'Otros Documentos'
        ];

        foreach ($tiposDocumentos as $campo => $nombre) {
            if ($request->hasFile($campo)) {
                $archivo = $request->file($campo);
                $nombreArchivo = time() . '_' . $campo . '_' . $user->id . '.pdf';
                $ruta = $archivo->storeAs('documentos', $nombreArchivo, 'public');
                
                $documentosGuardados[$campo] = [
                    'nombre' => $nombre,
                    'archivo' => $ruta,
                    'fecha_subida' => now()->toDateTimeString(),
                ];
            }
        }

        // Actualizar el usuario usando el modelo Eloquent
        $nuevosDocumentos = array_merge($documentosSubidos, $documentosGuardados);
        
        // Usar el método de consulta directa para evitar problemas con el modelo
        User::where('id', $user->id)->update([
            'documentos_subidos' => json_encode($nuevosDocumentos),
            'estado_aprobacion' => !empty($documentosGuardados) ? 'pendiente' : ($user->estado_aprobacion ?? 'pendiente'),
            'fecha_solicitud_aprobacion' => !empty($documentosGuardados) ? now() : ($user->fecha_solicitud_aprobacion ?? null),
        ]);

        if (!empty($documentosGuardados)) {
            return back()->with('document_success', 'Documentos subidos correctamente. Tu perfil está ahora en revisión.');
        } else {
            return back()->with('document_info', 'No se subieron nuevos documentos.');
        }
    }

    /**
     * Eliminar un documento específico
     */
    public function delete(Request $request, $tipoDocumento)
    {
        $user = Auth::user();
        $documentosSubidos = $user->documentos_subidos ?? [];

        // Verificar si el documento existe
        if (!array_key_exists($tipoDocumento, $documentosSubidos)) {
            return back()->with('error', 'El documento no existe.');
        }

        // Eliminar el archivo físico
        $documento = $documentosSubidos[$tipoDocumento];
        if (Storage::disk('public')->exists($documento['archivo'])) {
            Storage::disk('public')->delete($documento['archivo']);
        }

        // Eliminar el documento del array
        unset($documentosSubidos[$tipoDocumento]);

        // Actualizar la base de datos
        User::where('id', $user->id)->update([
            'documentos_subidos' => json_encode($documentosSubidos),
            'estado_aprobacion' => empty($documentosSubidos) ? 'pendiente' : 'pendiente',
        ]);

        return back()->with('document_success', 'Documento eliminado correctamente.');
    }
}

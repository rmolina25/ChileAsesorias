<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    /**
     * Mostrar la lista de solicitudes recibidas
     */
    public function index()
    {
        // Por ahora, datos de ejemplo
        // En el futuro aquí se conectaría con la base de datos real
        $solicitudes = [
            [
                'cliente_nombre' => 'María González',
                'tema' => 'Ansiedad',
                'descripcion' => 'Busca ayuda para manejo de ansiedad en situaciones sociales.',
                'fecha' => 'Hace 2 horas',
                'estado' => 'Pendiente'
            ],
            [
                'cliente_nombre' => 'Carlos López',
                'tema' => 'Desarrollo Personal',
                'descripcion' => 'Interesado en coaching para desarrollo profesional.',
                'fecha' => 'Hace 5 horas',
                'estado' => 'Pendiente'
            ],
            [
                'cliente_nombre' => 'Ana Martínez',
                'tema' => 'Relaciones Interpersonales',
                'descripcion' => 'Necesita orientación para mejorar comunicación en relaciones.',
                'fecha' => 'Hace 1 día',
                'estado' => 'Pendiente'
            ]
        ];

        return view('asesor.solicitudes', compact('solicitudes'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Availability;

class AvailabilityController extends Controller
{
    /**
     * Mostrar el formulario de gestión de disponibilidad
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $availabilities = $user->availabilities()->orderBy('day_of_week')->orderBy('start_time')->get();
        
        $daysOfWeek = [
            'lunes' => 'Lunes',
            'martes' => 'Martes', 
            'miercoles' => 'Miércoles',
            'jueves' => 'Jueves',
            'viernes' => 'Viernes',
            'sabado' => 'Sábado',
            'domingo' => 'Domingo'
        ];

        return view('asesor.availability', compact('availabilities', 'daysOfWeek'));
    }

    /**
     * Almacenar una nueva disponibilidad
     */
    public function store(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Verificar si ya existe un horario para este día y rango
        $existing = $user->availabilities()
            ->where('day_of_week', $request->day_of_week)
            ->where(function($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function($q) use ($request) {
                          $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->first();

        if ($existing) {
            return back()->with('error', 'Ya existe un horario que se superpone con este rango.');
        }

        Availability::create([
            'user_id' => $user->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_available' => true,
        ]);

        return back()->with('success', 'Horario agregado correctamente.');
    }

    /**
     * Actualizar una disponibilidad existente
     */
    public function update(Request $request, Availability $availability)
    {
        $this->authorize('update', $availability);

        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_available' => 'boolean',
        ]);

        $availability->update([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_available' => $request->is_available ?? true,
        ]);

        return back()->with('success', 'Horario actualizado correctamente.');
    }

    /**
     * Eliminar una disponibilidad
     */
    public function destroy(Availability $availability)
    {
        $this->authorize('delete', $availability);
        
        $availability->delete();

        return back()->with('success', 'Horario eliminado correctamente.');
    }

    /**
     * Obtener disponibilidades para un día específico (API)
     */
    public function getByDay($day)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $availabilities = $user->availabilities()
            ->where('day_of_week', $day)
            ->orderBy('start_time')
            ->get();

        return response()->json($availabilities);
    }
}

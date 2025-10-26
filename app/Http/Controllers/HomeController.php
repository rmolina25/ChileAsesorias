<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the solicitante dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function solicitanteDashboard()
    {
        if (\Illuminate\Support\Facades\Auth::user()->tipo_usuario !== 'solicitante') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
        return view('solicitante.dashboard');
    }

    /**
     * Show the asesor dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function asesorDashboard()
    {
        if (\Illuminate\Support\Facades\Auth::user()->tipo_usuario !== 'asesor') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
        return view('asesor.dashboard');
    }
}

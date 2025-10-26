<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfessionalInfoController;
use App\Http\Controllers\SolicitudController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/solicitante/dashboard', [App\Http\Controllers\HomeController::class, 'solicitanteDashboard'])->name('solicitante.dashboard');
Route::get('/asesor/dashboard', [App\Http\Controllers\HomeController::class, 'asesorDashboard'])->name('asesor.dashboard');

// Ruta para actualizar foto de perfil
Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');

// Rutas para gestión de disponibilidad
Route::get('/availabilities', [AvailabilityController::class, 'index'])->name('availabilities.index');
Route::post('/availabilities', [AvailabilityController::class, 'store'])->name('availabilities.store');
Route::put('/availabilities/{availability}', [AvailabilityController::class, 'update'])->name('availabilities.update');
Route::delete('/availabilities/{availability}', [AvailabilityController::class, 'destroy'])->name('availabilities.destroy');
Route::get('/availabilities/day/{day}', [AvailabilityController::class, 'getByDay'])->name('availabilities.getByDay');

// Ruta para actualizar redes sociales
Route::put('/social-media', [SocialMediaController::class, 'update'])->name('social-media.update');

// Ruta para subir documentos profesionales
Route::post('/documents/upload', [DocumentController::class, 'upload'])->name('documents.upload');
// Ruta para eliminar documentos profesionales
Route::delete('/documents/delete/{tipoDocumento}', [DocumentController::class, 'delete'])->name('documents.delete');

// Ruta para actualizar información profesional
Route::put('/professional-info', [ProfessionalInfoController::class, 'update'])->name('professional-info.update');

// Ruta para ver solicitudes de clientes
Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');

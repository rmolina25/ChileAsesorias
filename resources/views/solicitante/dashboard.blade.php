@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar de Navegación -->
        <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#inicio">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#buscar-asesores">
                            <i class="fas fa-search"></i> Buscar Asesores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#mis-solicitudes">
                            <i class="fas fa-list"></i> Mis Solicitudes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#perfil">
                            <i class="fas fa-user"></i> Mi Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ayuda">
                            <i class="fas fa-question-circle"></i> Ayuda
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contenido Principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Mensajes de éxito -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Header del Dashboard -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard del Solicitante</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-primary">Nueva Solicitud</button>
                        <button type="button" class="btn btn-sm btn-outline-success">Buscar Ayuda</button>
                    </div>
                </div>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>3</h4>
                                    <p>Solicitudes Activas</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-list fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>2</h4>
                                    <p>Asesores Contactados</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>1</h4>
                                    <p>Sesiones Programadas</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-calendar fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>5</h4>
                                    <p>Asesores Disponibles</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Búsqueda de Asesores -->
            <div id="buscar-asesores" class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Buscar Asesores Disponibles</h5>
                        </div>
                        <div class="card-body">
                            <!-- Filtros de Búsqueda -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="especialidad" class="form-label">Especialidad</label>
                                    <select class="form-select" id="especialidad">
                                        <option selected>Todas las especialidades</option>
                                        <option>Psicología</option>
                                        <option>Coaching</option>
                                        <option>Terapia</option>
                                        <option>Desarrollo Personal</option>
                                        <option>Orientación Vocacional</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="ubicacion" class="form-label">Modalidad</label>
                                    <select class="form-select" id="ubicacion">
                                        <option selected>Todas las modalidades</option>
                                        <option>Presencial</option>
                                        <option>Virtual</option>
                                        <option>Ambas</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="calificacion" class="form-label">Calificación Mínima</label>
                                    <select class="form-select" id="calificacion">
                                        <option selected>Cualquier calificación</option>
                                        <option>4.5+ estrellas</option>
                                        <option>4.0+ estrellas</option>
                                        <option>3.5+ estrellas</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary">Buscar Asesores</button>

                            <!-- Resultados de Búsqueda -->
                            <div class="mt-4">
                                <h6>Asesores Recomendados</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <img src="https://via.placeholder.com/60" class="rounded-circle me-3" alt="Asesor">
                                                    <div>
                                                        <h6 class="mb-1">Dra. Ana Martínez</h6>
                                                        <p class="text-muted mb-1">Psicóloga Clínica • 4.9★</p>
                                                        <small>Especialista en ansiedad y depresión</small>
                                                        <div class="mt-2">
                                                            <span class="badge bg-primary me-1">Virtual</span>
                                                            <span class="badge bg-success me-1">Presencial</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-sm btn-outline-primary">Ver Perfil</button>
                                                    <button class="btn btn-sm btn-success">Solicitar Ayuda</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <img src="https://via.placeholder.com/60" class="rounded-circle me-3" alt="Asesor">
                                                    <div>
                                                        <h6 class="mb-1">Lic. Carlos Rodríguez</h6>
                                                        <p class="text-muted mb-1">Coach Profesional • 4.8★</p>
                                                        <small>Especialista en desarrollo personal</small>
                                                        <div class="mt-2">
                                                            <span class="badge bg-primary me-1">Virtual</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-sm btn-outline-primary">Ver Perfil</button>
                                                    <button class="btn btn-sm btn-success">Solicitar Ayuda</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Mis Solicitudes -->
            <div id="mis-solicitudes" class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Mis Solicitudes de Ayuda</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Asesor</th>
                                            <th>Especialidad</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Asesor">
                                                    <span>Dra. Ana Martínez</span>
                                                </div>
                                            </td>
                                            <td>Psicología Clínica</td>
                                            <td><span class="badge bg-success">Aceptada</span></td>
                                            <td>23/10/2025</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary">Ver Detalles</button>
                                                <button class="btn btn-sm btn-outline-success">Contactar</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Asesor">
                                                    <span>Lic. Carlos Rodríguez</span>
                                                </div>
                                            </td>
                                            <td>Coaching Personal</td>
                                            <td><span class="badge bg-warning">En revisión</span></td>
                                            <td>22/10/2025</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary">Ver Detalles</button>
                                                <button class="btn btn-sm btn-outline-secondary">Esperando</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Asesor">
                                                    <span>Mg. Laura Fernández</span>
                                                </div>
                                            </td>
                                            <td>Terapia Familiar</td>
                                            <td><span class="badge bg-info">Programada</span></td>
                                            <td>21/10/2025</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary">Ver Detalles</button>
                                                <button class="btn btn-sm btn-outline-info">Unirse</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary">Nueva Solicitud</button>
                                <button class="btn btn-outline-secondary">Ver Historial Completo</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Perfil -->
            <div id="perfil" class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            @if(Auth::user()->foto_perfil)
                                <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" class="rounded-circle mb-3" alt="Foto de perfil" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="Foto de perfil">
                            @endif
                            <h4>{{ Auth::user()->name }}</h4>
                            <p class="text-muted">Usuario Solicitante</p>
                            <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data" id="form-photo">
                                @csrf
                                @method('PUT')
                                <div class="d-grid gap-2">
                                    <label for="foto_perfil" class="btn btn-primary">Cambiar Foto de Perfil</label>
                                    <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" style="display: none;" onchange="document.getElementById('form-photo').submit()">
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="mb-0">Información Personal</h6>
                        </div>
                        <div class="card-body">
                            <p><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</p>
                            @if(Auth::user()->telefono)
                                <p><i class="fas fa-phone"></i> {{ Auth::user()->telefono }}</p>
                            @else
                                <p><i class="fas fa-phone"></i> <span class="text-muted">No especificado</span></p>
                            @endif
                            @if(Auth::user()->direccion || Auth::user()->ciudad)
                                <p><i class="fas fa-map-marker-alt"></i>
                                    {{ Auth::user()->direccion ? Auth::user()->direccion . ', ' : '' }}
                                    {{ Auth::user()->ciudad ?? '' }}
                                </p>
                            @else
                                <p><i class="fas fa-map-marker-alt"></i> <span class="text-muted">Ubicación no especificada</span></p>
                            @endif
                            @if(Auth::user()->fecha_nacimiento)
                                @php
                                    $edad = \Carbon\Carbon::parse(Auth::user()->fecha_nacimiento)->age;
                                @endphp
                                <p><i class="fas fa-birthday-cake"></i> {{ $edad }} años</p>
                            @else
                                <p><i class="fas fa-birthday-cake"></i> <span class="text-muted">Edad no especificada</span></p>
                            @endif
                            @if(Auth::user()->username)
                                <p><i class="fas fa-user"></i> {{ Auth::user()->username }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Preferencias de Búsqueda -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Mis Preferencias</h5>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Editar Información
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Áreas de Interés</h6>
                                    <div class="mb-3">
                                        <span class="badge bg-primary me-1 mb-1">Ansiedad</span>
                                        <span class="badge bg-primary me-1 mb-1">Desarrollo Personal</span>
                                        <span class="badge bg-primary me-1 mb-1">Orientación Vocacional</span>
                                        <span class="badge bg-primary me-1 mb-1">Relaciones</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6>Preferencias de Sesión</h6>
                                    <ul class="list-unstyled">
                                        <li>✓ Prefiero sesiones virtuales</li>
                                        <li>✓ Disponible fines de semana</li>
                                        <li>✓ Sesiones de 60 minutos</li>
                                    </ul>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">Actualizar Preferencias</button>
                        </div>
                    </div>

                    <!-- Historial Reciente -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">Actividad Reciente</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">Solicitud enviada a Dra. Ana Martínez</h6>
                                        <small class="text-muted">Hoy</small>
                                    </div>
                                    <p class="mb-1">Para manejo de ansiedad en situaciones sociales</p>
                                </div>
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">Sesión programada con Lic. Carlos Rodríguez</h6>
                                        <small class="text-muted">Ayer</small>
                                    </div>
                                    <p class="mb-1">Coaching para desarrollo profesional - 25/10/2025 15:00</p>
                                </div>
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">Perfil actualizado</h6>
                                        <small class="text-muted">Hace 3 días</small>
                                    </div>
                                    <p class="mb-1">Se agregaron nuevas preferencias de búsqueda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100;
    padding: 48px 0 0;
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

.sidebar .nav-link {
    font-weight: 500;
    color: #333;
    padding: 0.5rem 1rem;
}

.sidebar .nav-link.active {
    color: #007bff;
}

.sidebar .nav-link:hover {
    color: #007bff;
}

main {
    margin-left: 0;
}

@media (min-width: 768px) {
    main {
        margin-left: 240px;
    }
}

.badge {
    font-size: 0.75em;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}
</style>

<!-- Font Awesome para iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
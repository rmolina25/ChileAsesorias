@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar de Navegación -->
        <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky pt-3">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span><i class="fas fa-bars me-2"></i>Menú Principal</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('asesor.dashboard') }}">
                            <i class="fas fa-user"></i> Mi Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('solicitudes.index') }}">
                            <i class="fas fa-list"></i> Solicitudes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('availabilities.index') }}">
                            <i class="fas fa-calendar"></i> Disponibilidad
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#estadisticas">
                            <i class="fas fa-chart-bar"></i> Estadísticas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#redes">
                            <i class="fas fa-share-alt"></i> Redes Sociales
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contenido Principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Header de la Página -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Solicitudes de Clientes</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-primary">Filtrar</button>
                        <button type="button" class="btn btn-sm btn-outline-success">Exportar</button>
                    </div>
                </div>
            </div>

            <!-- Mensajes de éxito -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Lista de Solicitudes -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Solicitudes de Clientes Recibidas</h5>
                        </div>
                        <div class="card-body">
                            @if(isset($solicitudes) && count($solicitudes) > 0)
                                <div class="list-group">
                                    @foreach($solicitudes as $solicitud)
                                        <div class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">{{ $solicitud['cliente_nombre'] }} - {{ $solicitud['tema'] }}</h6>
                                                <small class="text-muted">{{ $solicitud['fecha'] }}</small>
                                            </div>
                                            <p class="mb-1">{{ $solicitud['descripcion'] }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    <i class="fas fa-clock"></i> {{ $solicitud['estado'] }}
                                                </small>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-success">Tomar Solicitud</button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger">Rechazar Solicitud</button>
                                                    <button type="button" class="btn btn-sm btn-outline-info">Ver Detalles</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No hay solicitudes pendientes</h5>
                                    <p class="text-muted">Cuando los clientes te envíen solicitudes, aparecerán aquí.</p>
                                    <a href="{{ route('asesor.dashboard') }}" class="btn btn-primary">
                                        <i class="fas fa-arrow-left"></i> Volver al Dashboard
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros y Búsqueda -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Filtros de Búsqueda</h6>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="estado" class="form-label">Estado</label>
                                            <select class="form-select" id="estado">
                                                <option value="">Todos los estados</option>
                                                <option value="pendiente">Pendiente</option>
                                                <option value="aceptada">Aceptada</option>
                                                <option value="rechazada">Rechazada</option>
                                                <option value="completada">Completada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="fecha_desde" class="form-label">Fecha desde</label>
                                            <input type="date" class="form-control" id="fecha_desde">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="fecha_hasta" class="form-label">Fecha hasta</label>
                                            <input type="date" class="form-control" id="fecha_hasta">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="tema" class="form-label">Tema</label>
                                            <input type="text" class="form-control" id="tema" placeholder="Buscar por tema...">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                                <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                            </form>
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
</style>

<!-- Font Awesome para iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
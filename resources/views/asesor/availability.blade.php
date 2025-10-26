@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar de Navegación -->
        <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('asesor.dashboard') }}">
                            <i class="fas fa-arrow-left"></i> Volver al Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-calendar"></i> Gestión de Horarios
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contenido Principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Mensajes -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Gestión de Disponibilidad Semanal</h1>
            </div>

            <!-- Formulario para agregar horarios -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Agregar Nuevo Horario</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('availabilities.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="day_of_week" class="form-label">Día de la Semana</label>
                                        <select class="form-select" id="day_of_week" name="day_of_week" required>
                                            <option value="">Seleccionar día</option>
                                            @foreach($daysOfWeek as $key => $day)
                                                <option value="{{ $key }}">{{ $day }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="start_time" class="form-label">Hora de Inicio</label>
                                        <input type="time" class="form-control" id="start_time" name="start_time" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="end_time" class="form-label">Hora de Fin</label>
                                        <input type="time" class="form-control" id="end_time" name="end_time" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Agregar Horario</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de horarios existentes -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Horarios Programados</h5>
                        </div>
                        <div class="card-body">
                            @if($availabilities->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Día</th>
                                                <th>Horario</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($availabilities as $availability)
                                                <tr>
                                                    <td>{{ $availability->day_of_week_spanish }}</td>
                                                    <td>{{ $availability->time_range }}</td>
                                                    <td>
                                                        @if($availability->is_available)
                                                            <span class="badge bg-success">Disponible</span>
                                                        @else
                                                            <span class="badge bg-danger">No disponible</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <form action="{{ route('availabilities.destroy', $availability) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este horario?')">
                                                                    <i class="fas fa-trash"></i> Eliminar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No hay horarios programados. Agrega tu disponibilidad semanal.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vista semanal resumida -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Vista Semanal Resumida</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($daysOfWeek as $key => $day)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">{{ $day }}</h6>
                                            </div>
                                            <div class="card-body">
                                                @php
                                                    $dayAvailabilities = $availabilities->where('day_of_week', $key);
                                                @endphp
                                                @if($dayAvailabilities->count() > 0)
                                                    @foreach($dayAvailabilities as $avail)
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <span class="small">{{ $avail->time_range }}</span>
                                                            @if($avail->is_available)
                                                                <span class="badge bg-success">✓</span>
                                                            @else
                                                                <span class="badge bg-danger">✗</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-muted small mb-0">Sin horarios programados</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
</style>

<!-- Font Awesome para iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
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
                        <a class="nav-link active" href="#perfil">
                            <i class="fas fa-user"></i> Mi Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('solicitudes.index') }}">
                            <i class="fas fa-list"></i> Solicitudes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#disponibilidad">
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
            <!-- Mensajes de éxito -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Header del Dashboard -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard del Asesor</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-primary">Compartir Perfil</button>
                        <button type="button" class="btn btn-sm btn-outline-success">Generar Reporte</button>
                    </div>
                </div>
            </div>

            <!-- Barra de Estado de Aprobación -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Estado de Verificación Profesional</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $documentosSubidos = Auth::user()->documentos_subidos ?? [];
                                $estado = Auth::user()->estado_aprobacion ?? 'pendiente';
                                $documentosSubidosCount = count($documentosSubidos);
                                
                                // Determinar el estado basado en los documentos subidos
                                if ($documentosSubidosCount === 0) {
                                    $estadoBarra = 'sin_archivos';
                                    $textoBarra = 'No Hay Archivos Para Revisión';
                                    $colorBarra = 'secondary';
                                    $porcentaje = 0;
                                } elseif ($estado == 'aprobado') {
                                    $estadoBarra = 'aprobado';
                                    $textoBarra = 'Archivos Aprobados';
                                    $colorBarra = 'success';
                                    $porcentaje = 100;
                                } elseif ($estado == 'rechazado') {
                                    $estadoBarra = 'rechazado';
                                    $textoBarra = 'Archivos Reprobados';
                                    $colorBarra = 'danger';
                                    $porcentaje = 100;
                                } else {
                                    $estadoBarra = 'pendiente';
                                    $textoBarra = 'En proceso de revisión';
                                    $colorBarra = 'warning';
                                    $porcentaje = 100; // Siempre 100% cuando hay al menos un documento y está pendiente
                                }
                            @endphp
                            
                            <div class="progress mb-3" style="height: 25px;">
                                <div class="progress-bar bg-{{ $colorBarra }} progress-bar-striped progress-bar-animated"
                                     role="progressbar"
                                     style="width: {{ $porcentaje }}%"
                                     aria-valuenow="{{ $porcentaje }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                    {{ $textoBarra }}
                                </div>
                            </div>

                            @if($documentosSubidosCount === 0)
                                <div class="alert alert-secondary">
                                    <i class="fas fa-file-upload"></i> Aún no has subido archivos para revisión. Por favor sube los documentos que acrediten tu profesión.
                                </div>
                            @elseif($estado == 'pendiente')
                                <div class="alert alert-warning">
                                    <i class="fas fa-clock"></i> Tus documentos están en revisión. El proceso puede tomar hasta 3 días hábiles.
                                </div>
                            @elseif($estado == 'rechazado')
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Archivos Reprobados:</strong>
                                    {{ Auth::user()->motivo_rechazo ?? 'No se proporcionó motivo específico' }}
                                </div>
                            @elseif($estado == 'aprobado')
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> ¡Felicidades! Tus documentos han sido verificados y aprobados.
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-clock"></i> Tus documentos están en revisión. El proceso puede tomar hasta 3 días hábiles.
                                </div>
                            @endif

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Progreso de verificación</span>
                                <span class="badge bg-{{ $colorBarra }}">{{ $textoBarra }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Documentos -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Documentos Profesionales</h5>
                        </div>
                        <div class="card-body">
                            @if(session('document_success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('document_success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('document_info'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{ session('document_info') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <p class="text-muted mb-3">
                                    Sube los documentos que acrediten tu formación y experiencia profesional.
                                    Los documentos serán revisados por nuestro equipo de verificación.
                                </p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6><i class="fas fa-file-pdf text-danger"></i> Título Profesional</h6>
                                                <p class="text-muted small">Documento que acredita tu título profesional</p>
                                                <div class="mb-2">
                                                    <input type="file" class="form-control form-control-sm" name="titulo_profesional" accept=".pdf">
                                                </div>
                                                <small class="text-muted">Formato aceptado: PDF (Máx. 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6><i class="fas fa-file-pdf text-danger"></i> Certificaciones</h6>
                                                <p class="text-muted small">Certificados adicionales o especializaciones</p>
                                                <div class="mb-2">
                                                    <input type="file" class="form-control form-control-sm" name="certificaciones" accept=".pdf">
                                                </div>
                                                <small class="text-muted">Formato aceptado: PDF (Máx. 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6><i class="fas fa-file-pdf text-danger"></i> Cédula Profesional</h6>
                                                <p class="text-muted small">Documento oficial de cédula profesional</p>
                                                <div class="mb-2">
                                                    <input type="file" class="form-control form-control-sm" name="cedula_profesional" accept=".pdf">
                                                </div>
                                                <small class="text-muted">Formato aceptado: PDF (Máx. 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6><i class="fas fa-file-pdf text-danger"></i> Otros Documentos</h6>
                                                <p class="text-muted small">Cualquier otro documento relevante</p>
                                                <div class="mb-2">
                                                    <input type="file" class="form-control form-control-sm" name="otros_documentos" accept=".pdf">
                                                </div>
                                                <small class="text-muted">Formato aceptado: PDF (Máx. 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Importante:</strong> Todos los documentos deben ser legibles y estar actualizados.
                                    El proceso de verificación puede tomar hasta 3 días hábiles.
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane"></i> Enviar para Revisión
                                </button>
                            </form>

                            <!-- Mostrar documentos ya subidos -->
                            @php
                                $documentosSubidos = Auth::user()->documentos_subidos ?? [];
                            @endphp
                            @if(!empty($documentosSubidos))
                                <div class="mt-4">
                                    <h6>Documentos Subidos</h6>
                                    <div class="row">
                                        @foreach($documentosSubidos as $tipo => $documento)
                                            <div class="col-md-6 mb-2">
                                                <div class="card">
                                                    <div class="card-body py-2">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                                                <span class="small">{{ $documento['nombre'] }}</span>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <span class="badge bg-success small me-2">Subido</span>
                                                                <form action="{{ route('documents.delete', $tipo) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este documento?')">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Subido el: {{ \Carbon\Carbon::parse($documento['fecha_subida'])->format('d/m/Y H:i') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Perfil -->
            <div id="perfil" class="row mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            @if(Auth::user()->foto_perfil)
                                <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" class="rounded-circle mb-3" alt="Foto de perfil" style="width: 150px; height: 150px; object-fit: cover;">
                                 {{ Auth::user()->foto_perfil }} -->
                            @else
                                <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="Foto de perfil">
                               
                            @endif
                            <h4>{{ Auth::user()->name }}</h4>
                            <p class="text-muted">
                                @if((Auth::user()->estado_aprobacion ?? 'pendiente') == 'aprobado')
                                    <span class="badge bg-success">Asesor Verificado</span>
                                @else
                                    <span class="badge bg-warning">En Proceso de Verificación</span>
                                @endif
                            </p>
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
                            <h6 class="mb-0">Información de Contacto</h6>
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
                            @if(Auth::user()->username)
                                <p><i class="fas fa-user"></i> {{ Auth::user()->username }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Información Profesional -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Información Profesional</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#professionalInfoModal">
                                <i class="fas fa-edit"></i> Editar Información
                            </button>
                        </div>
                        <div class="card-body">
                            @php
                                $especialidades = Auth::user()->especialidades ?? [];
                                $certificaciones = Auth::user()->certificaciones ?? [];
                                $biografia = Auth::user()->biografia_profesional;
                                
                                $hasProfessionalInfo = !empty($especialidades) || !empty($certificaciones) || !empty($biografia);
                            @endphp

                            @if(!$hasProfessionalInfo)
                                <div class="text-center py-4">
                                    <i class="fas fa-user-tie fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Aún no has agregado información profesional. Completa tu perfil para mostrar tus habilidades y experiencia.</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#professionalInfoModal">
                                        <i class="fas fa-plus"></i> Agregar Información
                                    </button>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Especialidades</h6>
                                        <div class="mb-3">
                                            @if(!empty($especialidades))
                                                @foreach($especialidades as $especialidad)
                                                    <span class="badge bg-primary me-1 mb-1">{{ $especialidad }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No especificadas</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Certificaciones</h6>
                                        @if(!empty($certificaciones))
                                            <ul class="list-unstyled">
                                                @foreach($certificaciones as $certificacion)
                                                    <li>✓ {{ $certificacion }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted">No especificadas</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6>Biografía Profesional</h6>
                                    @if(!empty($biografia))
                                        <p class="text-muted">{{ $biografia }}</p>
                                    @else
                                        <p class="text-muted">No se ha agregado biografía profesional.</p>
                                    @endif
                                </div>

                            @endif
                        </div>
                    </div>

                    <!-- Modal para editar información profesional -->
                    <div class="modal fade" id="professionalInfoModal" tabindex="-1" aria-labelledby="professionalInfoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="professionalInfoModalLabel">Editar Información Profesional</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('professional-info.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        @if(session('professional_success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('professional_success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label for="especialidades" class="form-label">Especialidades</label>
                                            <input type="text" class="form-control" id="especialidades" name="especialidades[]"
                                                   placeholder="Ej: Psicología, Coaching, Terapia"
                                                   value="{{ implode(', ', Auth::user()->especialidades ?? []) }}">
                                            <small class="text-muted">Separa las especialidades con comas</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="certificaciones" class="form-label">Certificaciones</label>
                                            <textarea class="form-control" id="certificaciones" name="certificaciones[]" rows="3"
                                                      placeholder="Ej: Certificado en Psicología Clínica, Coach Profesional Certificado">{{ implode(', ', Auth::user()->certificaciones ?? []) }}</textarea>
                                            <small class="text-muted">Separa las certificaciones con comas</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="biografia_profesional" class="form-label">Biografía Profesional</label>
                                            <textarea class="form-control" id="biografia_profesional" name="biografia_profesional" rows="4"
                                                      placeholder="Describe tu experiencia profesional, especialidades y enfoque...">{{ Auth::user()->biografia_profesional ?? '' }}</textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Disponibilidad -->
                    <div class="card mt-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Disponibilidad Semanal</h5>
                            <a href="{{ route('availabilities.index') }}" class="btn btn-sm btn-outline-primary">Gestionar Horarios</a>
                        </div>
                        <div class="card-body">
                            @php
                                $userAvailabilities = Auth::user()->availabilities;
                                $daysOfWeek = [
                                    'lunes' => 'Lunes',
                                    'martes' => 'Martes',
                                    'miercoles' => 'Miércoles',
                                    'jueves' => 'Jueves',
                                    'viernes' => 'Viernes',
                                    'sabado' => 'Sábado',
                                    'domingo' => 'Domingo'
                                ];
                            @endphp
                            
                            @if($userAvailabilities->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Día</th>
                                                <th>Horarios Disponibles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daysOfWeek as $key => $day)
                                                @php
                                                    $dayAvailabilities = $userAvailabilities->where('day_of_week', $key)->where('is_available', true);
                                                @endphp
                                                <tr>
                                                    <td>{{ $day }}</td>
                                                    <td>
                                                        @if($dayAvailabilities->count() > 0)
                                                            @foreach($dayAvailabilities as $availability)
                                                                <span class="badge bg-success me-1 mb-1">
                                                                    {{ $availability->start_time->format('H:i') }} - {{ $availability->end_time->format('H:i') }}
                                                                </span>
                                                            @endforeach
                                                        @else
                                                            <span class="badge bg-secondary">Sin horarios</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                                    <p class="text-muted mb-0">No hay horarios programados</p>
                                    <a href="{{ route('availabilities.index') }}" class="btn btn-sm btn-primary mt-2">Configurar Horarios</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Redes Sociales -->
            <div id="redes" class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Redes Sociales y Contacto</h5>
                        </div>
                        <div class="card-body">
                            @if(session('social_media_success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('social_media_success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('social-media.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="linkedin_url" class="form-label">
                                                <i class="fab fa-linkedin text-primary"></i> LinkedIn
                                            </label>
                                            <input type="url" class="form-control" id="linkedin_url" name="linkedin_url"
                                                   placeholder="https://linkedin.com/in/tu-perfil"
                                                   value="{{ Auth::user()->linkedin_url ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="instagram_url" class="form-label">
                                                <i class="fab fa-instagram text-danger"></i> Instagram
                                            </label>
                                            <input type="url" class="form-control" id="instagram_url" name="instagram_url"
                                                   placeholder="https://instagram.com/tu-usuario"
                                                   value="{{ Auth::user()->instagram_url ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook_url" class="form-label">
                                                <i class="fab fa-facebook text-primary"></i> Facebook
                                            </label>
                                            <input type="url" class="form-control" id="facebook_url" name="facebook_url"
                                                   placeholder="https://facebook.com/tu-perfil"
                                                   value="{{ Auth::user()->facebook_url ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="twitter_url" class="form-label">
                                                <i class="fab fa-twitter text-info"></i> Twitter
                                            </label>
                                            <input type="url" class="form-control" id="twitter_url" name="twitter_url"
                                                   placeholder="https://twitter.com/tu-usuario"
                                                   value="{{ Auth::user()->twitter_url ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="website_url" class="form-label">
                                                <i class="fas fa-globe text-success"></i> Sitio Web Personal
                                            </label>
                                            <input type="url" class="form-control" id="website_url" name="website_url"
                                                   placeholder="https://tu-sitio.com"
                                                   value="{{ Auth::user()->website_url ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="blog_url" class="form-label">
                                                <i class="fas fa-blog text-warning"></i> Blog Profesional
                                            </label>
                                            <input type="url" class="form-control" id="blog_url" name="blog_url"
                                                   placeholder="https://tu-blog.com"
                                                   value="{{ Auth::user()->blog_url ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Guardar Redes Sociales
                                    </button>
                                </div>
                            </form>

                            <!-- Vista previa de enlaces activos -->
                            <div class="mt-4">
                                <h6>Enlaces Activos</h6>
                                <div class="row">
                                    @if(Auth::user()->linkedin_url)
                                        <div class="col-md-4 text-center mb-3">
                                            <a href="{{ Auth::user()->linkedin_url }}" target="_blank" class="text-decoration-none">
                                                <i class="fab fa-linkedin fa-2x text-primary"></i>
                                                <p class="mt-2">LinkedIn</p>
                                            </a>
                                        </div>
                                    @endif
                                    @if(Auth::user()->instagram_url)
                                        <div class="col-md-4 text-center mb-3">
                                            <a href="{{ Auth::user()->instagram_url }}" target="_blank" class="text-decoration-none">
                                                <i class="fab fa-instagram fa-2x text-danger"></i>
                                                <p class="mt-2">Instagram</p>
                                            </a>
                                        </div>
                                    @endif
                                    @if(Auth::user()->facebook_url)
                                        <div class="col-md-4 text-center mb-3">
                                            <a href="{{ Auth::user()->facebook_url }}" target="_blank" class="text-decoration-none">
                                                <i class="fab fa-facebook fa-2x text-primary"></i>
                                                <p class="mt-2">Facebook</p>
                                            </a>
                                        </div>
                                    @endif
                                    @if(Auth::user()->twitter_url)
                                        <div class="col-md-4 text-center mb-3">
                                            <a href="{{ Auth::user()->twitter_url }}" target="_blank" class="text-decoration-none">
                                                <i class="fab fa-twitter fa-2x text-info"></i>
                                                <p class="mt-2">Twitter</p>
                                            </a>
                                        </div>
                                    @endif
                                    @if(Auth::user()->website_url)
                                        <div class="col-md-4 text-center mb-3">
                                            <a href="{{ Auth::user()->website_url }}" target="_blank" class="text-decoration-none">
                                                <i class="fas fa-globe fa-2x text-success"></i>
                                                <p class="mt-2">Sitio Web</p>
                                            </a>
                                        </div>
                                    @endif
                                    @if(Auth::user()->blog_url)
                                        <div class="col-md-4 text-center mb-3">
                                            <a href="{{ Auth::user()->blog_url }}" target="_blank" class="text-decoration-none">
                                                <i class="fas fa-blog fa-2x text-warning"></i>
                                                <p class="mt-2">Blog</p>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Solicitudes Recientes -->
            <div id="solicitudes" class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Solicitudes Recientes</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">María González - Ansiedad</h6>
                                        <small class="text-muted">Hace 2 horas</small>
                                    </div>
                                    <p class="mb-1">Busca ayuda para manejo de ansiedad en situaciones sociales.</p>
                                    <small class="text-muted">Solicitud prioritaria</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">Carlos López - Desarrollo Personal</h6>
                                        <small class="text-muted">Hace 5 horas</small>
                                    </div>
                                    <p class="mb-1">Interesado en coaching para desarrollo profesional.</p>
                                    <small class="text-muted">Disponible para videollamada</small>
                                </a>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary">Ver Todas las Solicitudes</button>
                                <button class="btn btn-outline-success">Configurar Preferencias</button>
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
</style>

<!-- Font Awesome para iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
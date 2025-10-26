@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section -->
    <div class="bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">Centro de Ayuda a la Comunidad</h1>
                    <p class="lead mb-4">Conectamos a nuestra comunidad con asesores especializados que te guiarán hacia el éxito</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <button class="btn btn-light btn-lg px-4">
                            <i class="fas fa-calendar-check me-2"></i>Solicitar Asesoría
                        </button>
                        <button class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-users me-2"></i>Conocer Asesores
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-hands-helping display-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-light py-4">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3">
                    <h3 class="text-primary fw-bold">50+</h3>
                    <p class="text-muted mb-0">Asesores Activos</p>
                </div>
                <div class="col-md-3">
                    <h3 class="text-primary fw-bold">1,200+</h3>
                    <p class="text-muted mb-0">Sesiones Realizadas</p>
                </div>
                <div class="col-md-3">
                    <h3 class="text-primary fw-bold">98%</h3>
                    <p class="text-muted mb-0">Satisfacción</p>
                </div>
                <div class="col-md-3">
                    <h3 class="text-primary fw-bold">24/7</h3>
                    <p class="text-muted mb-0">Soporte Disponible</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <!-- Introduction Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h2 class="card-title h1 mb-4 text-gradient">¿Necesitas ayuda profesional?</h2>
                                <p class="card-text fs-5 text-muted mb-4">
                                    Nuestro equipo de asesores altamente calificados está aquí para apoyarte en diversas áreas.
                                    Ya sea que necesites orientación profesional, consejos técnicos especializados o apoyo personal,
                                    tenemos expertos dispuestos a acompañarte en tu camino hacia el éxito.
                                </p>
                                <div class="d-flex gap-3 flex-wrap">
                                    <span class="badge bg-primary bg-gradient fs-6 p-2">Orientación Profesional</span>
                                    <span class="badge bg-success bg-gradient fs-6 p-2">Asesoría Técnica</span>
                                    <span class="badge bg-info bg-gradient fs-6 p-2">Apoyo Personal</span>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <i class="fas fa-rocket display-1 text-primary opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advisors Section -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-5">
                <h2 class="display-5 fw-bold text-dark mb-3">Nuestros Asesores Especializados</h2>
                <p class="lead text-muted">Conoce a nuestro equipo de expertos dispuestos a ayudarte</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Advisor 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card advisor-card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-header bg-gradient-primary text-white text-center py-4">
                        <div class="advisor-avatar mx-auto mb-3">
                            <i class="fas fa-user-tie fa-4x text-white"></i>
                        </div>
                        <h5 class="card-title mb-1">María González</h5>
                        <p class="card-subtitle opacity-75">Asesora Profesional</p>
                    </div>
                    <div class="card-body text-center p-4">
                        <p class="card-text text-muted mb-4">
                            Especialista en desarrollo de carrera y orientación laboral con más de 10 años
                            de experiencia en recursos humanos y coaching ejecutivo.
                        </p>
                        <div class="advisor-skills mb-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2 mb-2">Desarrollo Profesional</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2 mb-2">CV y Entrevistas</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 me-2 mb-2">Coaching Ejecutivo</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent text-center py-3">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>Disponible: Lunes a Viernes 9:00 - 18:00
                        </small>
                    </div>
                </div>
            </div>

            <!-- Advisor 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card advisor-card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-header bg-gradient-success text-white text-center py-4">
                        <div class="advisor-avatar mx-auto mb-3">
                            <i class="fas fa-laptop-code fa-4x text-white"></i>
                        </div>
                        <h5 class="card-title mb-1">Carlos Rodríguez</h5>
                        <p class="card-subtitle opacity-75">Asesor Técnico</p>
                    </div>
                    <div class="card-body text-center p-4">
                        <p class="card-text text-muted mb-4">
                            Experto en desarrollo web full-stack y tecnologías emergentes.
                            Especializado en Laravel, React, Node.js y arquitectura de software.
                        </p>
                        <div class="advisor-skills mb-4">
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 me-2 mb-2">Desarrollo Web</span>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 me-2 mb-2">Laravel & React</span>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 me-2 mb-2">Arquitectura</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent text-center py-3">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>Disponible: Martes a Sábado 14:00 - 22:00
                        </small>
                    </div>
                </div>
            </div>

            <!-- Advisor 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card advisor-card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-header bg-gradient-info text-white text-center py-4">
                        <div class="advisor-avatar mx-auto mb-3">
                            <i class="fas fa-heart fa-4x text-white"></i>
                        </div>
                        <h5 class="card-title mb-1">Ana Martínez</h5>
                        <p class="card-subtitle opacity-75">Asesora Psicológica</p>
                    </div>
                    <div class="card-body text-center p-4">
                        <p class="card-text text-muted mb-4">
                            Psicóloga clínica especializada en apoyo emocional, bienestar mental
                            y desarrollo personal para estudiantes y profesionales.
                        </p>
                        <div class="advisor-skills mb-4">
                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 me-2 mb-2">Salud Mental</span>
                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 me-2 mb-2">Bienestar</span>
                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 me-2 mb-2">Desarrollo Personal</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent text-center py-3">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>Disponible: Lunes a Jueves 10:00 - 16:00
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card bg-gradient-primary text-white border-0 shadow-lg">
                    <div class="card-body p-5 text-center">
                        <h3 class="card-title display-6 fw-bold mb-3">¿Listo para dar el siguiente paso?</h3>
                        <p class="card-text lead mb-4 opacity-75">
                            Agenda tu primera sesión gratuita con uno de nuestros asesores y descubre cómo podemos ayudarte a alcanzar tus objetivos.
                        </p>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <button class="btn btn-light btn-lg px-5 py-3 fw-bold">
                                <i class="fas fa-calendar-plus me-2"></i>Agendar Sesión Gratuita
                            </button>
                            <button class="btn btn-outline-light btn-lg px-5 py-3 fw-bold">
                                <i class="fas fa-envelope me-2"></i>Contactar por Email
                            </button>
                        </div>
                        <p class="mt-4 mb-0 opacity-75">
                            <i class="fas fa-info-circle me-2"></i>
                            También puedes escribirnos a: <strong>asesores@comunidad.com</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resources Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 py-4">
                        <h3 class="card-title text-center h2 mb-0 text-dark">
                            <i class="fas fa-toolbox me-3 text-primary"></i>
                            Recursos Adicionales
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3 h-100">
                                    <i class="fas fa-book fa-2x text-primary me-3"></i>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Guías y Tutoriales</h6>
                                        <small class="text-muted">Material educativo paso a paso</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3 h-100">
                                    <i class="fas fa-video fa-2x text-success me-3"></i>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Webinars Grabados</h6>
                                        <small class="text-muted">Sesiones formativas anteriores</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3 h-100">
                                    <i class="fas fa-users fa-2x text-info me-3"></i>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Grupos de Apoyo</h6>
                                        <small class="text-muted">Comunidades especializadas</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3 h-100">
                                    <i class="fas fa-calendar fa-2x text-warning me-3"></i>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Eventos Comunitarios</h6>
                                        <small class="text-muted">Próximos encuentros y talleres</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3 h-100">
                                    <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Material Descargable</h6>
                                        <small class="text-muted">Recursos en formato PDF</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3 h-100">
                                    <i class="fas fa-question-circle fa-2x text-secondary me-3"></i>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Preguntas Frecuentes</h6>
                                        <small class="text-muted">Respuestas a dudas comunes</small>
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

<style>
.text-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important;
}

.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.advisor-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.advisor-card .card-header {
    border-radius: 0.75rem 0.75rem 0 0 !important;
}

.card {
    border-radius: 0.75rem !important;
}

.btn {
    border-radius: 0.5rem !important;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}
</style>
@endsection

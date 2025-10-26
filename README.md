<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Estado de Build"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Descargas Totales"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Última Versión Estable"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="Licencia"></a>
</p>

## Acerca de ChileAsesorias

ChileAsesorias es una plataforma web desarrollada en Laravel que conecta a asesores profesionales con personas que necesitan servicios de asesoría en Chile.

### Características Principales

- **Sistema de usuarios dual**: Asesores y solicitantes
- **Gestión de disponibilidad**: Los asesores pueden definir sus horarios disponibles
- **Sistema de solicitudes**: Los usuarios pueden solicitar asesorías
- **Perfiles profesionales**: Los asesores pueden mostrar su experiencia y especialidades
- **Documentación**: Subida y gestión de documentos profesionales
- **Redes sociales**: Integración con perfiles sociales de los asesores

## Acerca de Laravel

Laravel es un framework de aplicación web con una sintaxis expresiva y elegante. Creemos que el desarrollo debe ser una experiencia agradable y creativa para ser verdaderamente satisfactorio. Laravel elimina las dificultades del desarrollo facilitando las tareas comunes utilizadas en muchos proyectos web, como:

- [Motor de enrutamiento simple y rápido](https://laravel.com/docs/routing).
- [Contenedor de inyección de dependencias potente](https://laravel.com/docs/container).
- Múltiples backends para almacenamiento de [sesión](https://laravel.com/docs/session) y [caché](https://laravel.com/docs/cache).
- [ORM de base de datos expresivo e intuitivo](https://laravel.com/docs/eloquent).
- [Migraciones de esquema independientes de la base de datos](https://laravel.com/docs/migrations).
- [Procesamiento robusto de trabajos en segundo plano](https://laravel.com/docs/queues).
- [Transmisión de eventos en tiempo real](https://laravel.com/docs/broadcasting).

Laravel es accesible, potente y proporciona las herramientas necesarias para aplicaciones grandes y robustas.

## Requisitos del Sistema

- PHP 8.1 o superior
- Composer
- Base de datos MySQL/PostgreSQL/SQLite
- Node.js y NPM

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/rmolina25/ChileAsesorias.git
cd ChileAsesorias
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de JavaScript:
```bash
npm install
```

4. Configurar el archivo de entorno:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la base de datos en el archivo `.env`

6. Ejecutar migraciones:
```bash
php artisan migrate
```

7. Compilar assets:
```bash
npm run build
```

8. Iniciar el servidor de desarrollo:
```bash
php artisan serve
```

## Estructura del Proyecto

- `app/Http/Controllers/` - Controladores de la aplicación
- `app/Models/` - Modelos de Eloquent
- `database/migrations/` - Migraciones de base de datos
- `resources/views/` - Vistas Blade
- `resources/views/asesor/` - Vistas para asesores
- `resources/views/solicitante/` - Vistas para solicitantes
- `routes/web.php` - Rutas de la aplicación

## Licencia

El framework Laravel es software de código abierto licenciado bajo la [licencia MIT](https://opensource.org/licenses/MIT).

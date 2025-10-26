<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Availability;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_usuario',
        'estado_aprobacion',
        'documentos_subidos',
        'fecha_solicitud_aprobacion',
        'fecha_aprobacion',
        'motivo_rechazo',
        'telefono',
        'direccion',
        'ciudad',
        'fecha_nacimiento',
        'genero',
        'foto_perfil',
        'username',
        'acepta_terminos',
        'linkedin_url',
        'instagram_url',
        'facebook_url',
        'twitter_url',
        'website_url',
        'blog_url',
        'especialidades',
        'certificaciones',
        'biografia_profesional',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'documentos_subidos' => 'array',
            'fecha_solicitud_aprobacion' => 'datetime',
            'fecha_aprobacion' => 'datetime',
            'fecha_nacimiento' => 'date',
            'acepta_terminos' => 'boolean',
            'especialidades' => 'array',
            'certificaciones' => 'array',
        ];
    }

    /**
     * Get the availabilities for the user.
     */
    public function availabilities(): HasMany
    {
        return $this->hasMany(Availability::class);
    }
}

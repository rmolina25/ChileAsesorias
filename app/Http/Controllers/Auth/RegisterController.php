<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Get the post registration redirect path based on user type.
     *
     * @return string
     */
    public function redirectTo()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        if ($user && $user->tipo_usuario === 'asesor') {
            return '/asesor/dashboard';
        } elseif ($user && $user->tipo_usuario === 'solicitante') {
            return '/solicitante/dashboard';
        }
        
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tipo_usuario' => ['required', 'in:solicitante,asesor'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'ciudad' => ['nullable', 'string', 'max:100'],
            'fecha_nacimiento' => ['nullable', 'date', 'before:today'],
            'genero' => ['nullable', 'in:masculino,femenino,otro'],
            'username' => ['nullable', 'string', 'max:50', 'unique:users'],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'acepta_terminos' => ['required', 'accepted'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $fotoPerfilPath = null;
        
        if (isset($data['foto_perfil'])) {
            $fotoPerfilPath = $data['foto_perfil']->store('fotos_perfil', 'public');
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tipo_usuario' => $data['tipo_usuario'],
            'telefono' => $data['telefono'] ?? null,
            'direccion' => $data['direccion'] ?? null,
            'ciudad' => $data['ciudad'] ?? null,
            'fecha_nacimiento' => $data['fecha_nacimiento'] ?? null,
            'genero' => $data['genero'] ?? null,
            'foto_perfil' => $fotoPerfilPath,
            'username' => $data['username'] ?? null,
            'acepta_terminos' => isset($data['acepta_terminos']) ? true : false,
        ]);
    }
}

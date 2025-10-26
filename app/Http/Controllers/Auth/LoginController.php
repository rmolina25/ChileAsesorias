<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Get the post login redirect path based on user type.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        Log::info('Intento de login', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        // Verificar si el usuario existe
        $user = \App\Models\User::where('email', $request->email)->first();
        
        if (!$user) {
            Log::warning('Usuario no encontrado', ['email' => $request->email]);
            return false;
        }

        Log::info('Usuario encontrado', [
            'email' => $user->email,
            'user_id' => $user->id
        ]);

        // Intentar autenticación
        $result = $this->guard()->attempt(
            $this->credentials($request), $request->boolean('remember')
        );

        Log::info('Resultado de autenticación', ['result' => $result]);

        return $result;
    }

}

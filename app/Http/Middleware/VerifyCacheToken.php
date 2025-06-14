<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;

class VerifyCacheToken
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->session()->get('auth_token');
        
        if (!$token || !$this->authService->validateToken($token)) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Debes iniciar sesión para continuar.',
            ]);
        }

        // Autenticar al usuario en la aplicación
        $user = $this->authService->validateToken($token);
        if ($user) {
            auth()->login($user);
        }

        return $next($request);
    }
}
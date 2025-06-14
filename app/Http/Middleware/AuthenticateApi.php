<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;

class AuthenticateApi
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        
        if (!$token || !$user = $this->authService->validateToken($token)) {
            return response()->json([
                'error' => 'No autorizado',
                'message' => 'Token inválido o sesión expirada'
            ], 401);
        }

        // Autentica al usuario y guarda el token actual
        auth()->setUser($user);
        $request->attributes->add(['current_token' => $token]);

        return $next($request);
    }
}
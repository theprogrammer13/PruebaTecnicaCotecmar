<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Inertia\Inertia;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // Mostrar formulario de login
    public function showLoginForm()
    {
        return Inertia::render('Auth/Login');
    }

    // Procesar login
    public function login(LoginRequest $request)
    {
        $tokenData = $this->authService->login(
            $request->username, 
            $request->password
        );

        if (!$tokenData) {
            return back()
                ->withInput($request->only('username')) // Mantener el valor del campo
                ->withErrors([
                    'username' => 'Credenciales inválidas',
                ]);
        }

        // Guardar token en sesión o cookies para Inertia
        $request->session()->put('auth_token', $tokenData['token']);
        return redirect()->route('reports')->with([
            'auth' => ['user' => $tokenData['user']]
        ]);

    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        $token = $request->session()->get('auth_token');
        
        if ($token) {
            $this->authService->logout($token);
            $request->session()->put('auth_token', null);
            $request->session()->forget('auth_token');
            Auth::logout();
        }

        return redirect()->route('login');
    }

    // Obtener usuario actual (para API si es necesario)
    public function user(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
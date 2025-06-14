<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VerifyApiToken
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('api_token')) {
            return redirect()->route('login');
        }

        // Opcional: Verificar token con la API
        try {
            $apiUrl = config('services.auth_api.url') . '/validate-token';
            $response = Http::withToken($request->session()->get('api_token'))
                ->get($apiUrl);

            if (!$response->successful()) {
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $username, string $password): ?array
    {
        $user = $this->userRepository->findByUsername($username);
        
        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        $token = $this->createSessionToken($user);
        
        return [
            'user' => $user,
            'token' => $token
        ];
    }

    protected function createSessionToken(User $user): string
    {
        $token = Str::random(60);
        
        Cache::put(
            "user_token_{$token}",
            $user->id,
            now()->addHours(8)
        );

        return $token;
    }

    public function logout(string $token): bool
    {
        if (!Cache::has("user_token_{$token}")) {
            return false;
        }

        return Cache::forget("user_token_{$token}");
    }

    public function validateToken(string $token): ?User
    {
        $userId = Cache::get("user_token_{$token}");
        
        if (!$userId) {
            return null;
        }

        return $this->userRepository->find($userId);
    }

    public function getAuthenticatedUser(): ?User
    {
        return auth()->user();
    }
}
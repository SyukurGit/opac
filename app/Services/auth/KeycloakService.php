<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class KeycloakService
{
    /**
     * Menangani logika callback dari Keycloak.
     * Memvalidasi data dan membuat atau memperbarui pengguna.
     *
     * @param \Laravel\Socialite\Contracts\User $keycloakUser
     * @return \App\Models\User
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handleCallback(SocialiteUser $keycloakUser): User
    {
        // Ambil email, jika tidak ada coba dari properti 'user'
        $email = $keycloakUser->getEmail() ?: ($keycloakUser->user['email'] ?? null);

        // Jika email tetap tidak ada, buat placeholder unik agar tidak gagal validasi
        if (!$email) {
            $email = "kc_{$keycloakUser->getId()}@noemail.local";
        }

        // Kumpulkan semua data yang relevan
        $userData = [
            'keycloak_id' => $keycloakUser->getId(),
            'email'       => $email,
            'name'        => $keycloakUser->getName() ?: ($keycloakUser->user['name'] ?? 'User ' . Str::substr($keycloakUser->getId(), 0, 6)),
            'username'    => $keycloakUser->getNickname(),
            'avatar'      => $keycloakUser->getAvatar(),
            'kc_payload'  => json_encode($keycloakUser->user),
        ];

        // Validasi data yang diterima
        $validator = Validator::make($userData, [
            'email'       => 'required|email',
            'name'        => 'required|string|max:255',
            'keycloak_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Catat error dan lemparkan exception
            Log::error('Keycloak user data validation failed', [
                'errors' => $validator->errors(),
                'data'   => $userData,
            ]);
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        // Cari pengguna berdasarkan email, atau buat yang baru jika tidak ada
        return User::updateOrCreate(
            [
                'email' => $userData['email'],
            ],
            [
                'name'              => $userData['name'],
                'keycloak_id'       => $userData['keycloak_id'],
                'username'          => $userData['username'],
                'avatar'            => $userData['avatar'],
                'kc_payload'        => $userData['kc_payload'],
                'email_verified_at' => now(), // Anggap email terverifikasi dari Keycloak
                'password'          => bcrypt('password'), // Atur password default (opsional)
            ]
        );
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\KeycloakService; // <- Pastikan use statement ini benar
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request; // <-- Tambahkan ini


class KeycloakController extends Controller
{
    /**
     * Mengarahkan pengguna ke halaman otentikasi Keycloak.
     */
    public function redirect()
    {
        return Socialite::driver('keycloak')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    /**
     * Menerima informasi pengguna dari Keycloak setelah login berhasil.
     */
    public function callback(KeycloakService $keycloakService)
    {
        try {
            $keycloakUser = Socialite::driver('keycloak')->user();

            // Panggil service untuk menangani semua logika
            $user = $keycloakService->handleCallback($keycloakUser);

            // Login-kan pengguna ke aplikasi
            Auth::login($user, remember: true);

            // Arahkan ke dashboard
            return redirect()->intended(route('admin.dashboard'));

        } catch (\Exception $e) {
            Log::error('Keycloak callback process failed: ' . $e->getMessage());
            return redirect('/')->with('error', 'Terjadi kesalahan saat otentikasi.');
        }
    }

    /**
     * Mengeluarkan pengguna dari aplikasi dan Keycloak.
     */
 
  public function logout()
    {
        // Logout dari aplikasi (hapus sesi Laravel)
        Auth::logout();

        // (Opsional) redirect kembali ke home setelah logout di Keycloak
        $redirectUri = Config::get('app.url'); // http://localhost:8000

        // Gunakan helper resmi provider (pastikan Post Logout Redirect URIs sudah diisi)
        return redirect(
            Socialite::driver('keycloak')->getLogoutUrl($redirectUri, env('KEYCLOAK_CLIENT_ID'))
        );
        // Catatan: getLogoutUrl mendukung kombinasi client_id / id_token_hint (Keycloak v18+).
        // Pastikan konfigurasi di Keycloak mengizinkan post_logout_redirect_uri.
    }

}
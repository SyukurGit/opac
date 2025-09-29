<?php

// app/Http/Controllers/Auth/KeycloakController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class KeycloakController extends Controller
{
    // 1) Redirect ke SSO
    public function redirect()
    {

        
        return Socialite::driver('keycloak')
            ->scopes(['openid','profile','email']) 
            ->redirect();
    }

    // 2) Callback dari SSO → ambil profil + buat/temukan user
    public function callback()
    {
        try {
            $kcUser = Socialite::driver('keycloak')->user();
            // print_r( $kcUser);
            // die();
        } catch (\Throwable $e) {
            return redirect()->route('home')->with('error', 'Login gagal: '.$e->getMessage());
        }

        // Ambil field umum
        $id    = $kcUser->getId();       // sub
        $email = $kcUser->getEmail() ?: ($kcUser->user['email'] ?? null);
        $name  = $kcUser->getName();
            //   ?: ($kcUser->user['name'] ?? $kcUser->getNickname() ?? 'User '.Str::substr($id, 0, 6));
        $avatar = $kcUser->getAvatar();
        $username = $kcUser->getNickname();



        // Kalau email tak tersedia, buat placeholder aman berbasis sub (hindari bentrok unique)
        if (!$email) {
            $email = "kc_{$id}@noemail.local";
        }

$valeu = [
                'name'         => $name,
                'keycloak_id'  => $id,
                'avatar'       => $avatar,
                'kc_payload'   => json_encode($kcUser->user),
                'email_verified_at' => now(),
                'username' => $username,

];

// print_r($valeu);
// die();

        // Upsert user lokal
        $user = User::updateOrCreate(
            ['email' => $email],
          $valeu
        );

        Auth::login($user, remember: true);

        // Arahkan ke dashboard (terproteksi)admin
    return redirect('/admin/dashboard');
    }



    // 3) Logout dari app + Keycloak (RP-Initiated Logout)
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

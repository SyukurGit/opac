<?php
// app/Http/Controllers/Admin/PenggunaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // <-- Panggil model User
use Illuminate\Http\Request;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    /**
     * Menampilkan halaman daftar pengguna yang terdaftar via SSO.
     */
    public function index(): View
    {
        // Ambil semua data pengguna dari tabel 'users', diurutkan dari yang terbaru login
        $users = User::latest('updated_at')->paginate(15);

        // Kirim data users ke view
        return view('admin.pengguna.index', compact('users'));
    }


    public function showLog(User $user): View
    {
        // Berkat Route Model Binding, Laravel otomatis mencari User berdasarkan ID di URL.
        // Untuk saat ini, kita hanya meneruskan data user ke view.
        return view('admin.pengguna.log', compact('user'));
    }
}
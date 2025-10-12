<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil seluruh data pengguna yang sedang login
        $user = Auth::user();

        // Mengirim data pengguna ke view
        return view('admin.dashboard.index', compact('user'));
    }
}
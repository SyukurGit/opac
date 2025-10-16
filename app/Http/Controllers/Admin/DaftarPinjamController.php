<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LoanService;
use Illuminate\Http\Request; 
use Illuminate\Support\Carbon; 

class DaftarPinjamController extends Controller
{
    protected $loanService;
    private const DENDA_PER_HARI = 1000; // Tarif denda per hari

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index(Request $request)
    {
        // 1. Ambil data mentah dari API
        $overdueLoansRaw = $this->loanService->getOverdueLoans();

        // 2. Proses setiap item untuk menambahkan data kalkulasi
       $processedLoans = array_map(function ($loan) {
    $dueDate = Carbon::parse($loan['due_date']);
    $daysOverdue = $dueDate->isPast() ? $dueDate->diffInDays(now()) : 0;

    $loan['keterlambatan'] = $daysOverdue;

    // --- UBAH BAGIAN INI ---
    // 1. Hitung denda seperti biasa
    $denda_kalkulasi = $daysOverdue * self::DENDA_PER_HARI;

    // 2. Bulatkan hasilnya ke bawah ke ribuan terdekat
    //    floor(2283288 / 1000) * 1000  ==>  floor(2283.288) * 1000  ==>  2283 * 1000  ==>  2283000
    $loan['denda'] = floor($denda_kalkulasi / 1000) * 1000;
    // --- AKHIR PERUBAHAN ---

    return $loan;
}, $overdueLoansRaw);

        // 3. Implementasi fungsionalitas pencarian
        if ($request->filled('search')) {
            $searchTerm = strtolower($request->input('search'));
            $processedLoans = array_filter($processedLoans, function ($loan) use ($searchTerm) {
                return str_contains(strtolower($loan['member_id']), $searchTerm) ||
                       str_contains(strtolower($loan['item_code']), $searchTerm);
            });
        }

        // 4. Kirim data yang sudah diolah ke view
        return view('admin.daftar_denda.index', [
            'daftar_denda' => $processedLoans
        ]);
    }
}
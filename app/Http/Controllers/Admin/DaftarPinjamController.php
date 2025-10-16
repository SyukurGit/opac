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

            // Tambahkan field baru ke setiap item
            $loan['keterlambatan'] = $daysOverdue;
            $loan['denda'] = $daysOverdue * self::DENDA_PER_HARI;

            return $loan;
        }, $overdueLoansRaw);

        // 3. Implementasi fungsionalitas pencarian (opsional tapi berguna)
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
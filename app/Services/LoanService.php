<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoanService
{
    /**
     * @var \Illuminate\Http\Client\PendingRequest
     */
    protected $httpClient;

    public function __construct()
    {
        $baseUrl = config('services.loan.base_url');

        if (!$baseUrl) {
            throw new \Exception('Loan API base URL is not configured.');
        }

        $this->httpClient = Http::baseUrl($baseUrl)
            ->timeout(15) // Timeout dalam 15 detik
            ->acceptJson();
    }

    /**
     * Mengambil semua data peminjaman yang lewat jatuh tempo.
     *
     * @return array
     */
    public function getOverdueLoans(): array
{
    try {
        $response = $this->httpClient->get('/opac/overdue');

        if ($response->failed()) {
            Log::error('Failed to fetch overdue loans', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            return [];
        }

        // Ambil data mentah dari API
        $overdueLoans = $response->json('data', []);

        // Proses setiap item untuk membulatkan nilai ke bawah
        $processedLoans = array_map(function($loan) {
            // Pastikan kuncinya ada sebelum diakses
            if (isset($loan['keterlambatan'])) {
                $loan['keterlambatan'] = floor($loan['keterlambatan']);
            }
            if (isset($loan['denda'])) {
                $loan['denda'] = floor($loan['denda']);
            }
            return $loan;
        }, $overdueLoans);

        // Kembalikan data yang sudah diproses
        return $processedLoans;

    } catch (\Exception $e) {
        Log::error('Exception when fetching overdue loans', [
            'message' => $e->getMessage()
        ]);
        return [];
    }
}
}
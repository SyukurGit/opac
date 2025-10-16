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
            $response = $this->httpClient->get('/api/v2/loan-overdue');

            if ($response->failed()) {
                // Log error jika panggilan API gagal
                Log::error('Failed to fetch overdue loans', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return []; // Kembalikan array kosong jika gagal
            }

            // Kembalikan hanya array 'data'
            return $response->json('data', []);

        } catch (\Exception $e) {
            Log::error('Exception when fetching overdue loans', [
                'message' => $e->getMessage()
            ]);
            return []; // Kembalikan array kosong jika ada exception
        }
    }
}
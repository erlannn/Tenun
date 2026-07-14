<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsappService
{
    protected $token;

    public function __construct()
    {
        $this->token = env('FONNTE_TOKEN');

        // Warn if the Fonnte token is not set. WhatsApp notifications will be disabled.
        if (empty($this->token)) {
            logger()->warning('Fonnte token (FONNTE_TOKEN) is missing or empty. WhatsApp notifications will be disabled.');
        }
    }

    /**
     * Mengirim pesan WhatsApp ke nomor tertentu
     */
    public function sendMessage($target, $message)
    {
        $target = $this->normalizeTarget($target);

        // If token is missing, skip HTTP request and return error structure.
        if (empty($this->token)) {
            logger()->warning('Attempted to send WhatsApp message without FONNTE_TOKEN.');
            return ['status' => false, 'reason' => 'FONNTE_TOKEN not configured'];
        }

        $response = Http::withoutVerifying()->withHeaders([
            'Authorization' => $this->token,
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $message,
            'countryCode' => '62', // Default Indonesia
        ]);

        return $response->json();
    }

    protected function normalizeTarget($target)
    {
        $target = preg_replace('/\D+/', '', (string) $target);

        if ($target === '') {
            return $target;
        }

        if (str_starts_with($target, '0')) {
            return '62' . substr($target, 1);
        }

        return $target;
    }
}
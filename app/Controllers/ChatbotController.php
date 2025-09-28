<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class ChatbotController extends BaseController
{
    public function askAI()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        $userPrompt = $this->request->getJsonVar('prompt');
        if (empty($userPrompt)) {
            return $this->response->setJSON(['error' => 'Prompt tidak boleh kosong.'])->setStatusCode(400);
        }

        try {
            $apiKey = getenv('GEMINI_API_KEY');

            if (empty($apiKey)) {
                log_message('error', 'GEMINI_API_KEY tidak ditemukan di file .env');
                return $this->response->setJSON(['error' => 'Konfigurasi layanan AI tidak valid.'])->setStatusCode(500);
            }


            $modelName = 'gemini-2.5-flash';
            $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/' . $modelName . ':generateContent?key=' . $apiKey;

            $payload = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $userPrompt]
                        ]
                    ]
                ]
            ];

            log_message('debug', '[ChatbotController] Requesting Gemini API URL: ' . $apiUrl);

            $client = Services::curlrequest([
                'timeout' => 45, 
            ]);

            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload
            ]);
            
            $statusCode = $response->getStatusCode();
            $body = $response->getBody();

            if ($statusCode !== 200) {
                log_message('error', "[ChatbotController] Gemini API Error (Status: {$statusCode}): {$body}");
                
                $errorData = json_decode($body, true);
                $errorMessage = $errorData['error']['message'] ?? 'Layanan AI tidak dapat dijangkau atau terjadi kesalahan.';

                // Periksa apakah ini error limit.
                if (str_contains(strtolower($errorMessage), 'resource has been exhausted') || $statusCode === 429) {
                    // Jika ya, kirim status 'limit_reached' dengan HTTP 200 OK
                    return $this->response->setJSON([
                        'status'    => 'limit_reached',
                        'csrf_hash' => csrf_hash()
                    ]); // <-- Perhatikan, tidak ada setStatusCode() lagi di sini, defaultnya adalah 200
                }

                // Jika error lain dari Gemini, lempar sebagai Exception agar ditangkap oleh blok catch utama
                throw new \Exception("Error dari API: " . $errorMessage);
            }

            $result = json_decode($body, true);
            
            // Validasi struktur response dari Gemini API
            if (!isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                log_message('error', '[ChatbotController] Invalid response structure: ' . $body);
                return $this->response->setJSON(['error' => 'Format response dari AI tidak valid.'])->setStatusCode(500);
            }
            
            $aiContent = $result['candidates'][0]['content']['parts'][0]['text'];

            return $this->response->setJSON([
                'status'    => 'success',
                'reply'     => $aiContent,
                'csrf_hash' => csrf_hash() 
            ]);

        } catch (\Exception $e) {
            log_message('error', '[ChatbotController] Exception: ' . $e->getMessage());

            // ▼▼▼ PENAMBAHAN LOGIKA UNTUK TIMEOUT ▼▼▼
            $errorMessage = 'Terjadi kesalahan pada server. Silakan coba lagi.';
            
            // Periksa apakah pesan exception mengandung kata "timed out"
            if (str_contains(strtolower($e->getMessage()), 'timed out')) {
                $errorMessage = 'Koneksi ke Asisten AI memakan waktu terlalu lama. Mohon coba beberapa saat lagi atau periksa koneksi internet Anda.';
            }
            // ▲▲▲ SELESAI ▲▲▲

            return $this->response->setJSON([
                'error'     => $errorMessage,
                'csrf_hash' => csrf_hash() // Kirim juga hash baru untuk keamanan
            ])->setStatusCode(500);
        }
    }
}


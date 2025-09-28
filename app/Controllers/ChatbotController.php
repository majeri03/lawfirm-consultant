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

            // ▼▼▼ PERBAIKAN: Menyesuaikan nama model dengan dokumentasi terbaru ▼▼▼
            // Menggunakan 'gemini-2.5-flash' sesuai contoh JavaScript yang Anda berikan.
            $modelName = 'gemini-2.5-flash';
            $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/' . $modelName . ':generateContent?key=' . $apiKey;
            // ▲▲▲ SELESAI ▲▲▲

            $payload = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $userPrompt]
                        ]
                    ]
                ]
            ];

            // Log URL yang akan di-request untuk keperluan debugging
            log_message('debug', '[ChatbotController] Requesting Gemini API URL: ' . $apiUrl);

            $client = Services::curlrequest([
                'timeout' => 45, // Waktu tunggu yang wajar untuk request AI
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

                return $this->response->setJSON(['error' => "Error dari API: " . $errorMessage])->setStatusCode($statusCode);
            }

            $result = json_decode($body, true);
            
            // Validasi struktur response dari Gemini API
            if (!isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                log_message('error', '[ChatbotController] Invalid response structure: ' . $body);
                return $this->response->setJSON(['error' => 'Format response dari AI tidak valid.'])->setStatusCode(500);
            }
            
            $aiContent = $result['candidates'][0]['content']['parts'][0]['text'];

            return $this->response->setJSON([
                'reply'     => $aiContent,
                'csrf_hash' => csrf_hash() 
            ]);

        } catch (\Exception $e) {
            log_message('error', '[ChatbotController] Exception: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Terjadi kesalahan pada server. Silakan coba lagi.'])->setStatusCode(500);
        }
    }
}


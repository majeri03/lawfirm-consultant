<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Google\Cloud\AIPlatform\V1\EndpointServiceClient;
use Google\Cloud\AIPlatform\V1\PredictResponse;
use Google\Cloud\AIPlatform\V1\Client\PredictionServiceClient;
use Google\Protobuf\Value;

class ChatbotController extends BaseController
{
    public function askAI()
    {
        // Hanya izinkan request AJAX
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        $userPrompt = $this->request->getJsonVar('prompt');
        if (empty($userPrompt)) {
            return $this->response->setJSON(['error' => 'Prompt tidak boleh kosong.'])->setStatusCode(400);
        }

        try {
            // --- KONFIGURASI YANG PERLU ANDA SESUAIKAN ---
            $projectId = 'fair-canto-468811-q1'; // Ganti dengan Project ID Google Cloud Anda
            $location = 'us-central1'; // Lokasi project, misal: us-central1, asia-southeast1 (Singapura)
            $modelId = 'gemini-1.0-pro';    // Model yang akan digunakan
            // -------------------------------------------

            $client = new PredictionServiceClient([
                'apiEndpoint' => $location . '-aiplatform.googleapis.com'
            ]);

            $endpoint = $client->modelName($projectId, $location, $modelId);

            $prompt = [
                'contents' => [
                    ['role' => 'user', 'parts' => [
                        ['text' => $userPrompt]
                    ]]
                ]
            ];

            $parameters = new Value([
                'struct_value' => [
                    'temperature'     => 0.3,
                    'maxOutputTokens' => 2048,
                    'topP'            => 0.8,
                    'topK'            => 40,
                ]
            ]);

            // Kirim request ke Vertex AI
            $response = $client->predict($endpoint, [$prompt], $parameters);

            // Ambil dan format jawaban dari AI
            $predictionResult = $response->getPredictions()[0];
            $aiContent = $predictionResult['content']['parts'][0]['text'];

            return $this->response->setJSON(['reply' => $aiContent]);

        } catch (\Exception $e) {
            log_message('error', '[ChatbotController] ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Maaf, terjadi kesalahan saat menghubungi layanan AI.'])->setStatusCode(500);
        }
    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class GeminiService
{
    // La teva clau API
    protected $apiKey = 'AIzaSyDfDazU4fnmr9_Tc_EFlLkdFEZ_SPXFPck';

    public function generarDescripcio($nomEstadi)
    {
        // ---------------------------------------------------------
        // 1. AUTODESCOBRIMENT (Tot inclòs aquí per evitar errors)
        // ---------------------------------------------------------
        
        // Busquem quin model tens disponible i el guardem a la Cache 1 dia
        $model = Cache::remember('gemini_best_model', 86400, function () {
            try {
                // Preguntem a Google quins models tens
                $response = Http::withoutVerifying()
                    ->get("https://generativelanguage.googleapis.com/v1beta/models?key={$this->apiKey}");

                if (!$response->successful()) {
                    Log::error("Error llistant models: " . $response->body());
                    return null;
                }

                $data = $response->json();
                
                // Busquem el primer model que serveixi per generar text
                foreach ($data['models'] ?? [] as $m) {
                    if (in_array('generateContent', $m['supportedGenerationMethods'] ?? [])) {
                        return $m['name']; // Retorna ex: 'models/gemini-1.5-flash'
                    }
                }
            } catch (\Exception $e) {
                Log::error("Excepció buscant models: " . $e->getMessage());
            }
            return null; // Si falla tot
        });

        // Si després de buscar no trobem cap model, mostrem l'error
        if (!$model) {
            return "ERROR CRÍTIC: No s'ha trobat cap model disponible per a la teva clau API. Revisa que l'API 'Generative Language API' estigui activada a Google Cloud.";
        }

        // ---------------------------------------------------------
        // 2. GENERACIÓ DEL TEXT
        // ---------------------------------------------------------
        $url = "https://generativelanguage.googleapis.com/v1beta/{$model}:generateContent";
        $prompt = "Escriu una descripció molt breu (40 paraules) i emocionant en català sobre l'estadi de futbol: '$nomEstadi'.";

        try {
            $response = Http::withoutVerifying()
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url . '?key=' . $this->apiKey, [
                    'contents' => [['parts' => [['text' => $prompt]]]]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Google ha respost sense text.';
            }

            return "Error generant amb $model (" . $response->status() . "): " . $response->body();

        } catch (\Exception $e) {
            return "Error de connexió: " . $e->getMessage();
        }
    }
}
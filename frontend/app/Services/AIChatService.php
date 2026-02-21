<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class AIChatService
{
    public function ask(string $query, array $vectorGroupIds, array $history = [], $system_prompt, array $few_shots_examples)
    {

        // 2. Call FastAPI
        $response = Http::timeout(360)->post('http://localhost:8003/chat', [
            'query' => $query,
            'file_group_ids' => $vectorGroupIds,
            'history' => $history, // Laravel sends the past messages
            'system_prompt' => $system_prompt,
            'few_shot_examples' => $few_shots_examples
            ]);

        return $response->json();
    }
}
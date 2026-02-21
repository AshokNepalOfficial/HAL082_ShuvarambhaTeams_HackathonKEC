<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class AIVectorService
{
    public function indexFile($file, string $quality, string $type)
    {
        // 1. Save file to a location FastAPI can access
        // $path = $file->store('ai_uploads', 'local');
        // $absolutePath = storage_path('app/' . $path);

        // 2. Call FastAPI
        $response = Http::timeout(360)->asForm()->post('http://localhost:8003/vectorize', [
            'file_path' => $file,
            'embedding_quality' => $quality,
            'file_type' => $type,
        ]);
        // dd($response);

        if ($response->failed()) {
            throw new \Exception("FastAPI Processing Failed");
        }

        $data = $response->json();
        // dd($data);

        // 3. Save to Database
        return $data;
    }
}
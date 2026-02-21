<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileType;
use App\Models\Folder;
use App\Models\VectorstoreQuality;
use App\Services\AIVectorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    protected $aiVectorService;

    public function __construct(AIVectorService $aiVectorService)
    {
        $this->aiVectorService = $aiVectorService;
    }

    public function store(Request $request, Folder $folder)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:10240',
            'filetype_id' => 'required|exists:file_type,id',
            'vectorstore_quality_id' => 'required|exists:vectorstore_quality,id',
            'is_vectorized' => 'required|boolean',
        ]);

        $file = $request->file('file');

        // Get extension safely (based on MIME type)
        $extension = $file->extension(); // safer than getClientOriginalExtension()

        // Generate unique filename and keep extension
        $filename = Str::uuid() . '.' . $extension;

        // Store file
        $path = $file->storeAs(
            'uploads/' . $folder->id,
            $filename,
            'public'
        );

        $configuration = null;

        if ($request->boolean('is_vectorized')) {
            $quality = VectorstoreQuality::findOrFail($validated['vectorstore_quality_id'])->name;
            $type = FileType::findOrFail($validated['filetype_id'])->name;

            $configuration = $this->aiVectorService->indexFile(
                $path,
                $quality,
                $type
            );
        }

        // Save to database
        $folder->files()->create([
            'filename' => $file->getClientOriginalName(), // keep original name for display
            'path' => $path,
            'filetype_id' => $validated['filetype_id'],
            'vectorstore_quality_id' => $validated['vectorstore_quality_id'],
            'is_vectorized' => $request->boolean('is_vectorized'),
            'filesize' => $file->getSize(),
            'configuration' => $configuration ? json_encode($configuration) : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully!',
        ]);
    }

    public function rename(Request $request, File $file)
    {
        $request->validate([
            'filename' => 'required|string|max:255'
        ]);

        $file->update([
            'filename' => $request->filename
        ]);

        return response()->json([
            'success' => true,
            'message' => 'File renamed successfully!',
        ]);
    }

    public function destroy(File $file)
    {
        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $file->delete();

        return response()->json([
            'success' => true,
            'message' => 'File deleted successfully!',
        ]);
    }
}
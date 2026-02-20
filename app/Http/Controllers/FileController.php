<?php
namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request, Folder $folder)
    {
        // Validation
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'filetype_id' => 'required|exists:file_type,id',
            'vectorstore_quality_id' => 'required|exists:vectorstore_quality,id',
            'is_vectorized' => 'required|boolean',
        ]);

        $file = $request->file('file');

        // Store file in public disk under folder ID
        $path = $file->store('uploads/' . $folder->id, 'public');

        // Save in database with additional fields
        $folder->files()->create([
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'filetype_id' => $request->filetype_id,
            'vectorstore_quality_id' => $request->vectorstore_quality_id,
            'is_vectorized' => $request->is_vectorized,
        ]);

        // Return JSON for modal handling
        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully!',
        ]);
    }

    // Rename file
    public function rename(Request $request, File $file)
    {
        $request->validate(['filename' => 'required|string|max:255']);
        $file->update(['filename' => $request->filename]);

        return response()->json([
            'success' => true,
            'message' => 'File renamed successfully!',
        ]);
    }

    // Delete file
    public function destroy(File $file)
    {
        // Delete from storage
        Storage::disk('public')->delete($file->path);

        // Delete database record
        $file->delete();

        return response()->json([
            'success' => true,
            'message' => 'File deleted successfully!',
        ]);
    }
}
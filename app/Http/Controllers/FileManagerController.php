<?php
namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileType;
use App\Models\Folder;
use App\Models\VectorstoreQuality;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FileManagerController extends Controller
{
    public function getItems(Request $request)
    {
        $parentId = $request->query('parent_id', null);
        $userId = auth()->id(); 

        // 1. Get Folders with item counts
        $folders = Folder::where('user_id', $userId)
            ->where('parent_id', $parentId)
            ->withCount(['files', 'subfolders']) // This adds files_count and subfolders_count
            ->get()
            ->map(function ($folder) {
                return [
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'type' => 'folder',
                    'parent_id' => $folder->parent_id,
                    'doc_type' => null,
                    'vector_store' => null,
                    // Sum of subfolders and files
                    'items_count' => $folder->files_count + $folder->subfolders_count, 
                    'updated_at' => $this->formatDate($folder->updated_at),
                ];
            });

        // 2. Get Files
        $files = File::where('folder_id', $parentId) 
            ->get()
            ->map(function ($file) {
                return [
                    'id' => $file->id,
                    'name' => $file->filename,
                    'type' => 'file',
                    'parent_id' => $file->folder_id,
                    'doc_type' => $file->filetype_id,
                    'vector_store' => $file->vectorstore_quality_id,
                    'is_vectorized' => $file->is_vectorized,
                    'items_count' => null, // Files don't contain items
                    'updated_at' => $this->formatDate($file->updated_at),
                ];
            });

        return response()->json([
            'items' => $folders->concat($files)
        ]);
    }

    private function formatDate($date)
    {
        $carbonDate = Carbon::parse($date);
        if ($carbonDate->gt(now()->subDay())) {
            return $carbonDate->diffForHumans();
        }
        return $carbonDate->format('M d, Y');
    }

    public function index(Request $request)
    {
        $parentId = $request->query('folder_id', null);
        $userId = auth()->id();

        // 1. Fetch Current Folder (for Breadcrumbs/Back button)
        $currentFolder = $parentId ? Folder::find($parentId) : null;

        // 2. Get Folders
        $folders = Folder::where('user_id', $userId)
            ->where('parent_id', $parentId)
            ->withCount(['files', 'subfolders'])
            ->get()
            ->map(function ($f) {
                $f->display_type = 'folder';
                $f->display_name = $f->name;
                $f->items_count = $f->files_count + $f->subfolders_count;
                return $f;
            });

        // 3. Get Files
        $files = File::where('folder_id', $parentId)
            ->get()
            ->map(function ($f) {
                $f->display_type = 'file';
                $f->display_name = $f->filename;
                return $f;
            });

        // 4. Merge and Paginate
        $allItems = $folders->concat($files);
        
        $perPage = 10;
        $page = $request->query('page', 1);
        $paginatedItems = new LengthAwarePaginator(
            $allItems->forPage($page, $perPage),
            $allItems->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $fileTypes = FileType::all();
        $vectorQualities = VectorstoreQuality::all();
        return view('file-manager.index', [
            'items' => $paginatedItems,
            'currentFolder' => $currentFolder,
            'parentId' => $parentId,
            'fileTypes' =>$fileTypes,
            'vectorQualities' =>$vectorQualities
        ]);
    }
    
}
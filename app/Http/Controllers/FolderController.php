<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    // Show all folders (top-level) and nested structure
    public function index()
    {
        $folders = Folder::where('user_id', auth()->id())
                         ->whereNull('parent_id')
                         ->with('children.files') // eager load children & files
                         ->get();

        return view('folders.index', compact('folders'));
    }

    // Create a new folder
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id',
        ]);

        Folder::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Folder created successfully!');
    }


     // Rename folder
    public function rename(Request $request, Folder $folder)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $folder->update(['name' => $request->name]);
        return back()->with('success', 'Folder renamed successfully!');
    }

    // Delete folder and all subfolders/files
    public function destroy(Folder $folder)
    {
        $folder->delete(); // cascade deletes children/files
        return back()->with('success', 'Folder deleted successfully!');
    }
}
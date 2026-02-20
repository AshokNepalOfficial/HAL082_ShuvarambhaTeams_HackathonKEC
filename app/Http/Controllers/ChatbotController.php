<?php

namespace App\Http\Controllers;

use App\Models\Chatbot;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChatbotController extends Controller
{
    public function store(Request $request)
    {
        // 1. VALIDATE ALL INPUTS FIRST
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'files_id' => 'nullable|array',
            'files_id.*' => 'exists:files,id', // Check if each file ID exists
            'folder_id' => 'nullable|array',
            'folder_id.*' => 'exists:folders,id', // Check if each folder ID exists
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            return DB::transaction(function () use ($request) {
                // 2. CREATE THE CHATBOT
                $chatbot = Chatbot::create([
                    'user_id' => Auth::id(),
                    'name'    => $request->name,
                    'status'  => 'draft',
                    'configuration' => [
                        'system_prompt' => '',
                        'few_shot_examples' => '',
                    ],
                ]);

                // 3. LOGIC TO MERGE FILE IDS
                // Get IDs directly from the files array
                $directFileIds = $request->input('files_id', []);

                // Get all file IDs that belong to the selected folders
                $folderIds = $request->input('folder_id', []);
                $filesFromFolders = File::whereIn('folder_id', $folderIds)
                                        ->pluck('id')
                                        ->toArray();

                // Merge and get unique IDs
                $finalFileIds = array_unique(array_merge($directFileIds, $filesFromFolders));

                // 4. ATTACH TO PIVOT TABLE (chatbot_files)
                if (!empty($finalFileIds)) {
                    $chatbot->files()->attach($finalFileIds);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Chatbot created successfully!',
                    'data' => $chatbot
                ]);
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }



    
    public function index(Request $request)
    {
        $chatbots = Chatbot::all();
        return view('chatbots.index', [
            'chatbots'=>$chatbots
        ]);
    }

    // public function edit(Request $request, Chatbot $chatbot)
    // {
    //     $selected_files = $chatbot->files()->get()->map(function($file){
    //         return [
    //             'id' => $file->id,
    //             'name' => $file->name,
    //             'file_sizes' => $file->size,
    //             'is_vectorized' => $file->is_vectorized,
    //             'configuration' => $file->configuration,
    //         ];
    //     });

    //     $go_back_url = url()->previous(); // previous page URL

    //     return view('chatbots.edit', [
    //         'chatbot' => [
    //             'id' => $chatbot->id,
    //             'name' => $chatbot->name,
    //             'description' => $chatbot->description,
    //             'selected_files' => $selected_files,
    //             'configurations' => $chatbot->configurations ? json_decode($chatbot->configurations, true) : [],
    //         ],
    //         'go_back_url' => $go_back_url,
    //     ]);
    // }



        /**
     * Show the edit page for a chatbot
     */
    public function edit(Request $request, Chatbot $chatbot)
    {
        // Map selected files
        $selected_files = $chatbot->files()->with('fileType')->get()->map(function ($file) {
            return [
                'id' => $file->id,
                'name' => $file->filename,
                'file_sizes' => $file->filesize,
                'file_type' => $file->fileType ? $file->fileType->name : null, // access as property
                'is_vectorized' => $file->is_vectorized,
            ];
        });


        $go_back_url = url()->previous(); // previous page URL

        return view('chatbots.edit', [
            'chatbot' => [
                'id' => $chatbot->id,
                'name' => $chatbot->name,
                'description' => $chatbot->description,
                'selected_files' => $selected_files,
                'configurations' => $chatbot->configurations ? json_decode($chatbot->configurations, true) : [],
            ],
            'go_back_url' => $go_back_url,
        ]);
    }


//     public function edit(Request $request, Chatbot $chatbot)
// {
//     // Map selected files
//     $selected_files = $chatbot->files()->with('fileType')->get()->map(function ($file) {
//         return [
//             'id' => $file->id,
//             'name' => $file->filename,
//             'file_sizes' => $file->filesize,
//             'file_type' => $file->fileType ? $file->fileType->name : null, // access as property
//             'is_vectorized' => $file->is_vectorized,
//         ];
//     });

//     $response_data = [
//         'chatbot' => [
//             'id' => $chatbot->id,
//             'name' => $chatbot->name,
//             'description' => $chatbot->description,
//             'selected_files' => $selected_files,
//             'configurations' => $chatbot->configurations ? json_decode($chatbot->configurations, true) : [],
//         ],
//         'go_back_url' => url()->previous(),
//     ];

//     // Return JSON response with pretty print
//     return response()->json($response_data, 200, [], JSON_PRETTY_PRINT);
// }

    /**
     * Handle the POST request to update the chatbot
     */
    public function update(Request $request, Chatbot $chatbot)
    {
        // Validate basic chatbot info
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'system_prompts' => 'nullable|string',
            'few_shots' => 'nullable|array',
            'few_shots.*.input' => 'nullable|string',
            'few_shots.*.output' => 'nullable|string',
        ]);

        // Update chatbot basic info
        $chatbot->name = $request->input('name');
        $chatbot->description = $request->input('description');

        // Prepare configurations JSON
        $configurations = [
            'system_prompts' => $request->input('system_prompts'),
            'few_shots' => $request->input('few_shots', []),
        ];

        $chatbot->configurations = json_encode($configurations);

        // Save the chatbot
        $chatbot->save();

        // Redirect back to edit page with success message
        return redirect()->route('chatbot.edit', $chatbot->id)
            ->with('success', 'Chatbot updated successfully!');
    }
}
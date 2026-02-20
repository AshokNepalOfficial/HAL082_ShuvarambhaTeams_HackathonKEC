<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChatbotFile extends Pivot
{
    // Explicitly set the table name
    protected $table = 'chatbot_files';

    // Disable timestamps because pivot tables usually don't have them
    public $timestamps = false;

    // Allow mass assignment
    protected $fillable = [
        'chatbot_id',
        'file_id',
    ];
}
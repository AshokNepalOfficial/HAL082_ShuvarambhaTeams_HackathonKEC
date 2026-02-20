<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel convention 'files')
    protected $table = 'files';

    // Mass assignable fields
    protected $fillable = [
        'filename',
        'filetype_id',
        'vectorstore_quality_id',
        'is_vectorized',
        'path',
        'folder_id',
    ];

    /**
     * Relationships
     */

    // File belongs to a folder
    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    // File belongs to a file type
    public function fileType()
    {
        return $this->belongsTo(FileType::class, 'filetype_id');
    }

    // File belongs to a vectorstore quality
    public function vectorstoreQuality()
    {
        return $this->belongsTo(VectorstoreQuality::class, 'vectorstore_quality_id');
    }
    // Owner of the file
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Chatbots associated with this file
    public function chatbots()
    {
        return $this->belongsToMany(Chatbot::class, 'chatbot_files');
    }
}

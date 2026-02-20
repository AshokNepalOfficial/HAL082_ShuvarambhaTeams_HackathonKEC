<?php

namespace App\Models;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = ['name', 'user_id', 'parent_id'];


    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

        // Relationship to files inside this folder
    public function files()
    {
        return $this->hasMany(File::class, 'folder_id');
    }

    // Relationship to subfolders inside this folder
    public function subfolders()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }
}
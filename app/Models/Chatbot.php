<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'status',
    ];

    // Chatbot owner
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Files attached to chatbot
    // Websites where chatbot is published
    public function websites()
    {
        return $this->belongsToMany(Website::class, 'chatbot_publish')
                    ->withPivot('published_at');
    }

    // Conversations of this chatbot
    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function files()
{
    return $this->belongsToMany(File::class, 'chatbot_files', 'chatbot_id', 'file_id');
}
}
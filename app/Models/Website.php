<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'name',
    ];

    // Chatbots published on this website
    public function chatbots()
    {
        return $this->belongsToMany(Chatbot::class, 'chatbot_publish')
                    ->withPivot('published_at');
    }
}
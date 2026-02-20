<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'chatbot_id',
        'user_type',
        'user_id',
        'guest_id',
    ];

    // Chatbot associated
    public function chatbot()
    {
        return $this->belongsTo(Chatbot::class);
    }

    // Messages in this conversation
    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at');
    }

    // If user type is 'user'
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If user type is 'guest'
    public function guest()
    {
        return $this->belongsTo(GuestUser::class, 'guest_id');
    }
}
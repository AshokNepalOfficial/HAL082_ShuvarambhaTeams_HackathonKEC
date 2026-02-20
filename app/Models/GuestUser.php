<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_token',
        'ip_address',
    ];

    // Conversations started by guest
    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'guest_id');
    }
}
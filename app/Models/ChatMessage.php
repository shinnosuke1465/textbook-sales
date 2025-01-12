<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChatRoom;
use App\Models\User;

class ChatMessage extends Model
{
    use HasFactory;
    protected $fillable = ['chat_room_id', 'user_id', 'message'];

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

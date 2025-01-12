<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChatRoomUser;
use App\Models\ChatMessage;

class ChatRoom extends Model
{
    use HasFactory;
    protected $fillable = ['textbook_id'];
    public function chatRoomUsers()
    {
        return $this->hasMany(ChatRoomUser::class);
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    // 多対多リレーションを定義
    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_room_users');
    }

    public function textbook()
    {
        return $this->belongsTo(Textbook::class);
    }
}

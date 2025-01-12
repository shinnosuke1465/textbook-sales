<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatRoomUser;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Models\User;

class TransactionController extends Controller
{
    public function index()
    {
        // 自分が参加しているトークルームのIDを取得
        $chatRoomIds = ChatRoomUser::where('user_id', Auth::id())
            ->pluck('chat_room_id');

        // トークルーム一覧を取得（教科書情報を含む）
        $chatRooms = ChatRoom::whereIn('id', $chatRoomIds)
            ->with([
                'users' => function ($query) {
                    $query->where('users.id', '<>', Auth::id()); // テーブル名を明示
                },
                'textbook' // 教科書情報のリレーションを取得
            ])
            ->get();

        return view('transaction.index', compact('chatRooms'));
    }

    public function show(Request $request)
    {
        // 対象の取引相手ユーザーIDを取得
        $matching_user_id = $request->user_id;

        // 現在のユーザーが参加しているチャットルームのIDを取得
        $current_user_chat_rooms = ChatRoomUser::where('user_id', Auth::id())
            ->pluck('chat_room_id');

        // 対象ユーザーとのチャットルームを探す
        $chat_room_id = ChatRoomUser::whereIn('chat_room_id', $current_user_chat_rooms)
            ->where('user_id', $matching_user_id)
            ->pluck('chat_room_id')
            ->first(); // チャットルームIDを取得

        if (!$chat_room_id) {
            abort(404, 'チャットルームが見つかりません');
        }

        // チャットルーム情報を取得
        $chat_room = ChatRoom::with('textbook')->findOrFail($chat_room_id);

        // チャット相手のユーザー情報を取得
        $chat_room_user = User::findOrFail($matching_user_id);

        // チャットメッセージを取得
        $chat_messages = ChatMessage::where('chat_room_id', $chat_room_id)
            ->orderBy('created_at')
            ->get();

        // ビューにデータを渡して表示
        return view('transaction.show', compact('chat_room', 'chat_room_user', 'chat_messages'));
    }
}

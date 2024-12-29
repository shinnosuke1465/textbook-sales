<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    // public function index()
    // {
    //     $posts = Post::all();

    //     return view('posts.index', ['posts' => $posts]);
    // }
    // ここから追加
    public static function index(Request $request)
    {

        //対象ユーザーのid取得
        $matching_user_id = $request->user_id;

        // 現在のユーザーのチャットルームを取得
        //ログインしているユーザー（例：user_id = 1）のchat_room_idをChatRoomUsersテーブルから取得
        $current_user_chat_rooms = ChatRoomUser::where('user_id', Auth::id())
            ->pluck('chat_room_id');

        // 対象ユーザーとのチャットルームを探す
        $chat_room_id = ChatRoomUser::whereIn('chat_room_id', $current_user_chat_rooms)
            ->where('user_id', $matching_user_id)
            ->pluck('chat_room_id');


        // チャットルームがなければ作成する
        //存在しなければ、新しいChatRoomを作成し、そのchat_room_idを2人のuser_idでChatRoomUsersテーブルに追加
        if ($chat_room_id->isEmpty()) {

            ChatRoom::create(); //チャットルーム作成

            $latest_chat_room = ChatRoom::orderBy('created_at', 'desc')->first(); //最新チャットルームを取得

            $chat_room_id = $latest_chat_room->id;

            // 新規登録 モデル側 $fillableで許可したフィールドを指定して保存
            ChatRoomUser::create(
                [
                    'chat_room_id' => $chat_room_id,
                    'user_id' => Auth::id()
                ]
            );

            ChatRoomUser::create(
                [
                    'chat_room_id' => $chat_room_id,
                    'user_id' => $matching_user_id
                ]
            );
        }

        // チャットルーム取得時はオブジェクト型なので数値に変換
        if (is_object($chat_room_id)) {
            $chat_room_id = $chat_room_id->first();
        }

        // チャット相手のユーザー情報を取得
        $chat_room_user = User::findOrFail($matching_user_id);

        // チャット相手のユーザー名を取得(JS用)
        $chat_room_user_name = $chat_room_user->name;

        $chat_messages = ChatMessage::where('chat_room_id', $chat_room_id)
            ->orderby('created_at')
            ->get();

        return view(
            'chat.show',
            compact(
                'chat_room_id',
                'chat_room_user',
                'chat_messages',
                'chat_room_user_name'
            )
        );
    }

    public function store(Request $request)
    {
        Post::create(
            [
                "comment" => $request->comment
            ]
        );

        return redirect('/posts')->with('success', '投稿が保存されました！');
    }
}

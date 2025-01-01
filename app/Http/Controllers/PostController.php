<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostRoomUser;
use App\Models\PostMessage;
use App\Models\User;
use Auth;

class PostController extends Controller
{
    public static function show(Request $request)
    {

        //対象ユーザーのid取得
        $matching_user_id = $request->user_id;

        // 現在のユーザーのチャットルームを取得
        //ログインしているユーザー（例：user_id = 1）のpost_idをPostRoomUsersテーブルから取得
        $current_user_post_rooms = PostRoomUser::where('user_id', Auth::id())->pluck('post_id');

        $post = Post::where('id', $current_user_post_rooms)->first();


        // チャットルーム取得時はオブジェクト型なので数値に変換
        if (is_object($current_user_post_rooms)) {
            $current_user_post_rooms = $current_user_post_rooms->first();
        }


        $post_messages = PostMessage::where('post_id', $current_user_post_rooms)
        ->orderby('created_at')
        ->get();

        // メッセージに登場するユーザーを一度に取得
        $user_ids = $post_messages->pluck('user_id')->unique(); // メッセージ内の全ユーザーIDを取得
        $users = User::whereIn('id', $user_ids)->get()->keyBy('id'); // ユーザー情報をキー（id）付きで取得

        // 同じ post_id に属するユーザーの数を取得
        $user_count = PostRoomUser::where('post_id', $current_user_post_rooms)->count();

        return view('posts.show', compact('post', 'post_messages', 'current_user_post_rooms', 'users', 'user_count'));
    }

    public function store(Request $request)
    {
        // Post::create(
        //     [
        //         "message" => $request->message
        //     ]
        // );
        $post = new PostMessage();
        $post->post_id = $request->post_id;
        $post->user_id = $request->user_id;
        $post->message = $request->message;
        $post->save();

        return redirect('/posts')->with('success', '投稿が保存されました！');
    }
}

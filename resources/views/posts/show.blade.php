@extends('layouts.app')

@section('title')
    掲示板
@endsection

@section('content')
    <div class="pg-post">
        @include('components.headline_base', [
            'title' => '掲示板',
        ])
        <div class="pg-post-inner container mx-auto">
            <h1 class="text-3xl font-bold mt-4 mb-2 text-center">{{ $post->title }}</h1>
            <p class="text-sm text-gray-600 text-center">現在の人数: {{ $user_count }}人</p>
            <div class="container">
                @foreach ($post_messages as $message)
                    <div class="message">
                        @if ($message->user_id == Auth::id())
                            <span>{{ Auth::user()->name }}</span>
                        @else
                        <span>{{ $users[$message->user_id]->name }}</span>
                        @endif

                        <div class="commonMessage">
                            <div>
                                {{ $message->message }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <form class="messageInputForm" method="POST" action="{{ route('posts.store') }}">
                @csrf
                <div class='container'>
                    <!-- メッセージ入力欄 -->
                    <input type="text" name="message" data-behavior="post_message" class="messageInputForm_input" placeholder="メッセージを入力..." required>
                    <!-- 隠しフィールドでスクリプト内の値を送信 -->
                    <input type="hidden" name="post_id" id="post_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="">
                </div>
                <button type="submit" class="btn btn-primary">送信</button>
            </form>
        さああ修正
        </div>
    </div>
    </div>
    <script>
        document.getElementById('post_id').value = {{ $current_user_post_rooms }};
        document.getElementById('user_id').value = {{ Auth::user()->id }};
    </script>
@endsection

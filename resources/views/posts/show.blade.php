@extends('layouts.app')

@section('title')
    掲示板
@endsection

@section('content')
    <div class="pg-post">
        @include('components.headline_base', [
            'title' => $post->title,
        ])
        <div class="pg-post-inner">
            <h2 class="pg-post-inner__number">現在の人数: {{ $user_count }}人</h2>
            <div class="pg-post-inner-container">
                @foreach ($post_messages as $message)
                    <div class="pg-post-inner-container__message">
                        <div class="pg-post-inner-container__heading">
                            @if ($message->user_id == Auth::id())
                                <span class="pg-post-inner-container__name">{{ Auth::user()->name }}</span>
                            @else
                            <span class="pg-post-inner-container__name">{{ $users[$message->user_id]->name }}</span>
                            @endif

                             <!-- 日付の表示を追加 -->
                             <span class="pg-post-inner-container__date">
                                ：{{ $message->created_at->format('Y年m月d日 H:i') }}
                            </span>
                        </div>

                        <div class="commonMessage">
                            <div>
                                {{ $message->message }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <form class="pg-post-inner-form" method="POST" action="{{ route('posts.store') }}">
                @csrf
                <div class='pg-post-inner-form__container'>
                    <!-- メッセージ入力欄 -->
                    <input type="text" name="message" data-behavior="post_message" class="pg-post-inner-form__input" autocomplete="off" placeholder="メッセージを入力..." required>
                    <!-- 隠しフィールドでスクリプト内の値を送信 -->
                    <input type="hidden" name="post_id" id="post_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="">
                </div>
                <button type="submit" class="pg-post-inner-form__button">送信</button>
            </form>
        </div>
    </div>
    </div>
    <script>
        document.getElementById('post_id').value = {{ $current_user_post_rooms }};
        document.getElementById('user_id').value = {{ Auth::user()->id }};
    </script>
@endsection

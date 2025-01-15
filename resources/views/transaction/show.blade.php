@extends('layouts.app')

@section('content')
    <div class="pg-transaction-chatPage">
        <div class="pg-transaction-chatPage-inner">
            <div class="pg-transaction-chatPage-inner-content">
                <div class="pg-transaction-chatPage-inner-content__button">
                    @include('components.button_back', [
                        'href' => route('transaction'),
                    ])
                </div>
                @include('components.headline_base', [
                    'title' => '商品情報',
                ])
                <div class="pg-transaction-chatPage-inner-content__info">
                    @include('components.thumbnail', [
                        'type' => 'textbooks',
                        'filename' => $chat_room->textbook->image_file_name,
                    ])
                    <div class="pg-transaction-chatPage-inner-content__list">
                        <div class="pg-transaction-chatPage-inner-content__item">
                            <div class="pg-transaction-chatPage-inner-content__item-left">教科書名:</div>
                            <div class="pg-transaction-chatPage-inner-content__item-right">
                                {{ $chat_room->textbook->name }}
                            </div>
                        </div>
                        <div class="pg-transaction-chatPage-inner-content__item">
                            <div class="pg-transaction-chatPage-inner-content__item-left">価格:</div>
                            <div class="pg-transaction-chatPage-inner-content__item-right">
                                {{ number_format($chat_room->textbook->price) }}円
                            </div>
                        </div>
                        <div class="pg-transaction-chatPage-inner-content__item">
                            <div class="pg-transaction-chatPage-inner-content__item-left">説明:</div>
                            <div class="pg-transaction-chatPage-inner-content__item-right">
                                {{ $chat_room->textbook->description }}
                            </div>
                        </div>
                        <div class="pg-transaction-chatPage-inner-content__item">
                            <div class="pg-transaction-chatPage-inner-content__item-left">出品者:</div>
                            <div class="pg-transaction-chatPage-inner-content__item-right">
                                {{ $chat_room->textbook->seller->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pg-transaction-chatPage-inner-message">
                @include('components.headline_base', [
                    'title' => 'メッセージ',
                ])
                <div class="messagesArea messages">
                    @foreach ($chat_messages as $message)
                        <div class="message">
                            @if ($message->user_id == Auth::id())
                                {{-- ログイン中のユーザー --}}
                                @if (!empty(Auth::user()->avatar_file_name))
                                    <figure class="c-header__image">
                                        <img src="{{ asset('storage/images/' . Auth::user()->avatar_file_name) }}"
                                            alt="{{ Auth::user()->name }}">
                                    </figure>
                                @else
                                    <figure class="c-header__image">
                                        <img src="/images/avatar-default.svg" alt="{{ Auth::user()->name }}">
                                    </figure>
                                @endif

                            @else
                                {{-- チャット相手のユーザー --}}
                                @if (!empty($chat_room_user->avatar_file_name))
                                    <figure class="c-header__image">
                                        <img src="{{ asset('storage/images/' . $chat_room_user->avatar_file_name) }}"
                                            alt="{{ $chat_room_user->name }}">
                                    </figure>
                                @else
                                    <figure class="c-header__image">
                                        <img src="/images/avatar-default.svg" alt="{{ $chat_room_user->name }}">
                                    </figure>
                                @endif
                            @endif
                            @if ($message->user_id == Auth::id())
                                <span class="pg-transaction-chatPage-inner-message__name">{{ Auth::user()->name }}</span>
                            @else
                                <span class="pg-transaction-chatPage-inner-message__name">{{ $chat_room_user_name }}</span>
                            @endif

                            <div class="commonMessage">
                                <div>
                                    {{ $message->message }}
                                </div>
                                <div class="message-time">{{ $message->created_at->format('H:i') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <form class="pg-transaction-chatPage-inner-message__form">
                    <input type="text" data-behavior="chat_message" class="pg-transaction-chatPage-inner-message__input"
                        placeholder="メッセージを入力..." required>
                    <button type="submit" class="pg-transaction-chatPage-inner-message__button">送信</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        var current_user_avatar = "{{ Auth::user()->avatar_file_name ? asset('storage/images/' . Auth::user()->avatar_file_name) : '/images/avatar-default.svg' }}";
        var chat_room_id = {{ $chat_room_id }};
        var user_id = {{ Auth::user()->id }};
        var current_user_name = "{{ Auth::user()->name }}";
        var chat_room_user_name = "{{ $chat_room_user_name }}";
    </script>
@endsection

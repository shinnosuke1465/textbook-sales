@extends('layouts.app')

@section('content')
    <div class="pg-transaction-chatPage">
        <div class="pg-transaction-chatPage-inner">
            {{-- <a href="{{route('matching')}}" class="linkToMatching"></a> --}}
            {{-- <div class="chatPartner">
                <div class="chatPartner_img"><img src="/storage/images/{{ $chat_room_user->img_name }}"></div>
                <div class="chatPartner_name">{{ $chat_room_user->name }}</div>
            </div> --}}
            <div class="pg-transaction-chatPage-inner-content">
                <div class="pg-transaction-chatPage-inner-content__button">
                    @include('components.button_back', [
                        'href' => route('transaction'),
                    ])
                </div>
                @include('components.headline_base', [
                    'title' => '商品情報',
                ])
                <div class="textbook-detail">
                    @include('components.thumbnail', [
                        'type' => 'textbooks',
                        'filename' => $chat_room->textbook->image_file_name,
                    ])
                    <p>教科書名: {{ $chat_room->textbook->name }}</p>
                    <p>価格: {{ number_format($chat_room->textbook->price) }}円</p>
                    <p>説明: {{ $chat_room->textbook->description }}</p>
                    <p>出品者: {{ $chat_room->textbook->seller->name }}</p>

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
                                <span>{{ Auth::user()->name }}</span>
                            @else
                                <span>{{ $chat_room_user_name }}</span>
                            @endif

                            <div class="commonMessage">
                                <div>
                                    {{ $message->message }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <form class="pg-transaction-chatPage-inner-message__form">
                    <input type="text" data-behavior="chat_message" class="pg-transaction-chatPage-inner-message__input"
                        placeholder="メッセージを入力...">
                    <button type="submit" class="pg-transaction-chatPage-inner-message__button">送信</button>
                </form>
            </div>
        </div>
    </div>
@endsection

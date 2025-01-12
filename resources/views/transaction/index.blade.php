@extends('layouts.app')

@section('title')
    取引一覧
@endsection

@section('content')
    <div class="pg-transaction">
        @include('components.headline_base', [
            'title' => '取引一覧',
        ])
        <div class="pg-transaction-inner">
            <ul class="pg-transaction-inner-list">
                @foreach ($chatRooms as $chatRoom)
                    @foreach ($chatRoom->users as $user)
                        <a
                            href="{{ route('transaction.show', ['user_id' => $user->id]) }}">
                            <li class="pg-transaction-inner-list-item">
                                <div class="pg-transaction-inner-list-item__left">
                                    @include('components.thumbnail', [
                                        'type' => 'textbooks',
                                        'filename' => $chatRoom->textbook->image_file_name,
                                    ])
                                    <div class="pg-transaction-inner-list-item__info">
                                        <p>{{ $user->name }}さんと「{{ $chatRoom->textbook->name }}」の取引があります</p>
                                    </div>
                                </div>
                                <span>＞</span>
                            </li>
                        </a>
                    @endforeach
                @endforeach
            </ul>
        </div>

    </div>
    </div>
@endsection

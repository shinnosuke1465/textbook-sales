@extends('layouts.app')

@section('title')
    商品一覧
@endsection

@section('content')
    <div class="pg-textbook">
        <div class="row">
            <div class="col-8 offset-2">
                {{-- フラッシュメッセージ表示 --}}
                <x-flash-message status="session('status')" />
            </div>
        </div>
        @include('components.headline_base', [
            'title' => '商品一覧',
        ])
        <ul class="pg-textbook__list">
            @foreach ($textbooks as $textbook)
                @include('textbooks._list_item')
            @endforeach
        </ul>
        <div class="flex justify-center">
            {{ $textbooks->appends([
                    'sort' => \Request::get('sort'),
                    'pagination' => \Request::get('pagination'),
                ])->links() }}
        </div>
        {{-- 掲示板遷移ボタン --}}
        @auth
            <a href="{{ route('posts.show') }}" type="submit" class="chatForm_btn">チャットを開く</a>
        @else
            <p class="text-gray-500">チャットを開くにはログインしてください。</p>
        @endauth
    </div>
@endsection

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
        <div class="pg-textbook__inner">
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
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    出品した商品一覧
@endsection

@section('content')
    <section class="pg-sold-items">

        <div class="pg-sold-items__content">
            @include('components.headline_base', [
                'title' => '出品した商品一覧',
            ])

            @foreach ($items as $item)
                @include('mypage._sold_item')
            @endforeach
        </div>
    </section>
@endsection

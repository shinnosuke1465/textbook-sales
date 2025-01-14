@extends('layouts.app')

@section('title')
    購入した商品一覧
@endsection

@section('content')
    <section class="pg-sold-items">

        <div class="pg-sold-items__content">
            @include('components.headline_base', [
                'title' => '購入した商品一覧',
            ])

            @foreach ($items as $item)
                @include('mypage._bought_item')
            @endforeach
        </div>
    </section>
@endsection

@extends('layouts.app')

@section('title')
{{$item->name}} | 商品編集
@endsection

@section('content')
    <section class="pg-textbook-detail pt-20">
        @include('textbooks._detail')
    </section>
@endsection

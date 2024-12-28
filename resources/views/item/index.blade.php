@extends('layouts.app')

@section('title')
    教科書名
@endsection

@section('content')
<div class="pg-item">
    @include('components.headline_base', [
        'title' => '教科書名',
    ])
    <div class="pg-item-inner">
        <div class="pg-item-inner__content">
            <input class="pg-item-inner__input js-item-search" type="text" placeholder="教科書を入力してください">
            <button class="pg-item-inner__button js-reset-button" type="button">×</button>
        </div>
        <ul class="pg-item-inner-list js-item-search-result"></ul>
    </div>

</div>
</div>
@endsection

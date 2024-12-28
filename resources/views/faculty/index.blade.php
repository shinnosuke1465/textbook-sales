@extends('layouts.app')

@section('title')
    学部名
@endsection

@section('content')
<div class="pg-faculty">
    @include('components.headline_base', [
        'title' => '学部名',
    ])
    <div class="pg-faculty-inner">
        <div class="pg-faculty-inner__content">
            <input class="pg-faculty-inner__input js-faculty-search" type="text" placeholder="学部名を入力してください">
            <button class="pg-faculty-inner__button js-reset-button" type="button">×</button>
        </div>
        <ul class="pg-faculty-inner-list js-faculty-search-result"></ul>
    </div>

</div>
</div>
@endsection

@extends('layouts.app')

@section('title')
    大学名
@endsection

@section('content')
<div class="pg-university">
    @include('components.headline_base', [
        'title' => '大学名',
    ])
    <div class="pg-university-inner">
        <div class="pg-university-inner__content">
            <input class="pg-university-inner__input js-university-search" type="text" placeholder="大学名を入力してください">
            <button class="pg-university-inner__button js-reset-button" type="button">×</button>
        </div>
        <ul class="pg-university-inner-list js-university-search-result"></ul>
    </div>

</div>
</div>
@endsection

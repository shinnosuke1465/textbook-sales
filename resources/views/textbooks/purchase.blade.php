@extends('layouts.app')

@section('title')
    {{ $item->name }} | 商品購入
@endsection

@section('content')
    {{-- <script src="https://js.pay.jp/v2/pay.js"></script> --}}
    <section class="pg-textbook-purchase pt-20">
        <div class="pg-textbook-purchase-inner">
            <div class="row">
                <div class="col-8 offset-2">
                    {{-- フラッシュメッセージ表示 --}}
                    <x-flash-message status="session('status')" />
                </div>
            </div>

            @include('textbooks._purchase_heading', [
                'item' => $item,
            ])

            @php
                $info_items = [
                    [
                        'label' => 'カード番号',
                        'key' => 'number-form',
                    ],
                    [
                        'label' => '有効期限',
                        'key' => 'expiry-form',
                    ],
                    [
                        'label' => 'セキュリティコード',
                        'key' => 'cvc-form',
                    ],
                ];
            @endphp
            <ul class="pg-textbook-purchase-inner-info-list">
                {{-- <div class="card-form-alert alert alert-danger" role="alert" style="display: none"></div> --}}
                @foreach ($info_items as $item)
                    <li class="pg-textbook-purchase-inner-info-list-item">
                        <label for="{{ $item['key'] }}">{{ $item['label'] }}</label>
                        <div id="{{ $item['key'] }}" class="form-control"><!-- ここにフォームが生成されます --></div>
                    </li>
                @endforeach
            </ul>

            <button class="pg-textbook-purchase-inner__button" onclick="onSubmit(event)">購入</button>

            <form id="buy-form" method="POST" action="{{ route('textbook.purchase', [$item->id]) }}">
                @csrf
                <input type="hidden" id="card-token" name="card-token">
            </form>
        </div>
    </section>
    <script>
        var payjp = Payjp('{{ config('payjp.public_key') }}')

        var elements = payjp.elements()

        var numberElement = elements.create('cardNumber')
        var expiryElement = elements.create('cardExpiry')
        var cvcElement = elements.create('cardCvc')
        numberElement.mount('#number-form')
        expiryElement.mount('#expiry-form')
        cvcElement.mount('#cvc-form')

        function onSubmit(event) {
            const msgDom = document.querySelector('.card-form-alert');
            msgDom.style.display = "none";

            payjp.createToken(numberElement).then(function(r) {
                if (r.error) {
                    msgDom.innerText = r.error.message;
                    msgDom.style.display = "block";
                    return;
                }

                document.querySelector('#card-token').value = r.id;
                document.querySelector('#buy-form').submit();
            })
        }
    </script>
@endsection

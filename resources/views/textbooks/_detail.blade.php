<div class="pg-textbook-detail__content">
    {{-- 商品画像 --}}
    <div class="pg-textbook-detail__image">
        <div class="pg-textbook-detail__button-back">
            @include('components.button_back', [
                'href' => route('textbooks.index'),
            ])
        </div>
        @include('components.thumbnail', [
            'type' => 'textbooks',
            'filename' => $item->image_file_name,
        ])
    </div>

    <div class="pg-textbook-detail__info">
        <p class="pg-textbook-detail__name">
            {{ $item->name }}
        </p>
        <p class="pg-textbook-detail__university">
            {{ $item->university->name }} / {{ $item->faculty->name }}
        </p>

        <div class="pg-textbook-detail__price">
            <i class="fas fa-yen-sign"></i>
            <span>{{ number_format($item->price) }}</span>
        </div>


        <div class="pg-textbook-detail__description-area">
            <p class="pg-textbook-detail__description-title">商品の説明</p>
            <p class="pg-textbook-detail__description-text">{{ $item->description }}</p>
        </div>


        <p class="pg-textbook-detail__description-area">
        <p class="pg-textbook-detail__description-title">商品の状態</p>
        <p class="pg-textbook-detail__description-text">{{ $item->condition->name }}</p>
        </p>

        @if ($item->isStateSelling)
            <a class="pg-textbook-detail__button" href="{{ route('textbook.purchase', [$item->id]) }}">購入</a>
        @else
            <button class="pg-textbook-detail__button-sold" disabled>売却済み</button>
        @endif
    </div>
</div>

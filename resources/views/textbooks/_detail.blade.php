<div class="pg-textbook-detail__content">
    {{-- 商品画像 --}}
    <div class="pg-textbook-detail__image">
        @include('components.thumbnail', [
        'type' => 'textbooks',
        'filename' => $item->image_file_name,
        ])
    </div>

    <div class="pg-textbook-detail__info">
        <p class="pg-textbook-detail__name">
            {{ $item->name }}
        </p>

        <p class="pg-textbook-detail__description">
            {{ $item->description }}
        </p>

        <p class="pg-textbook-detail__university">
            {{ $item->university->name }} / {{ $item->faculty->name }}
        </p>

        <p class="pg-textbook-detail__condition">
            {{ $item->condition->name }}
        </p>

        <p class="pg-textbook-detail__price">
            {{ number_format($item->price) }}
        </p>

        <p class="pg-textbook-detail__created">
            {{ $item->created_at->format('Y年n月j日 H:i') }}
        </p>

        <a href="{{route('textbook.purchase', [$item->id])}}">購入</a>

    </div>
</div>

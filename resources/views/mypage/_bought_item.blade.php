<div class="c-sold-item">
    <div class="c-sold-item__image-area">
    @include('components.thumbnail', [
        'type' => 'textbooks',
        'filename' => $item->image_file_name,
    ])
    </div>
    <div class="c-sold-item__text-area">
        <div class="c-sold-item__info">
            {{--isStateSelling...textbookモデルで定義したアクセサを使用 --}}
            @if ($item->isStateSelling)
                <span class="c-sold-item__info-state">出品中</span>
            @else
                <span class="c-sold-item__info-sell">売却済</span>
            @endif
            <span>{{ $item->university->name }} /
                {{ $item->faculty->name }}</span>
        </div>
        <div class="c-sold-item__title">{{ $item->name }}</div>
        <div class="c-sold-item__price">
            <i class="fas fa-yen-sign"></i>
            <span class="ml-1">{{ number_format($item->price) }}</span>
            <i class="far fa-clock ml-3"></i>
            <span>{{ $item->created_at->format('Y年n月j日 H:i') }}</span>
        </div>
    </div>
</ぢ>

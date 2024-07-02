<li class="c-textbook-list-item">
    <a class="c-textbook-list-item__anchor">
        {{-- 商品画像 --}}
        <div class="c-textbook-list-item__image-area">
            @include('components.thumbnail', [
            'type' => 'textbooks',
            'filename' => $textbook->image_file_name,
            ])
            <div class="c-textbook-list-item__price">
                <i class="fas fa-yen-sign"></i>
                <span class="ml-1">{{ number_format($textbook->price) }}</span>
            </div>
            @if ($textbook->isStateBought)
                <span
                class="c-textbook-list-item__label"></span>
                <span class="c-textbook-list-item__label-text">SOLD</span>
            @endif
        </div>
        <div class="c-textbook-list-item__text-area">
            <h2 class="c-textbook-list-item__category">
                {{ $textbook->university->name }} / {{ $textbook->faculty->name }}
            </h2>
            <h1 class="c-textbook-list-item__name ">{{ $textbook->name }}</h1>
        </div>
    </a>
</li>

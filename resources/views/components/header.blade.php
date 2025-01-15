@php
    $header_items = [
        [
            'label' => '会員登録',
            'href' => route('register'),
        ],
        [
            'label' => 'ログイン',
            'href' => route('login'),
        ],
    ];

    $user_items = [
        [
            'label' => 'プロフィール編集',
            'href' => route('mypage.edit-profile'),
            'icon' => 'far fa-address-card',
        ],
        [
            'label' => '商品を出品する',
            'href' => route('textbooks.create'),
            'icon' => 'fas fa-camera',
        ],
        [
            'label' => '出品した商品',
            'href' => route('mypage.sold-items'),
            'icon' => 'fas fa-store-alt',
        ],
        [
            'label' => '購入した商品',
            'href' => route('mypage.bought-items'),
            'icon' => 'fas fa-shopping-bag',
        ],
        [
            'label' => '取引一覧',
            'href' => route('transaction'),
            'icon' => 'fas fa-comments',
        ],
        [
            'label' => 'ログアウト',
            'href' => route('logout'),
            'icon' => 'fas fa-sign-out-alt',
            'onclick' => "event.preventDefault(); document.getElementById('logout-form').submit();",
        ],
    ];
@endphp

<header class="c-header">
    <a class="c-header__logo" href="{{ route('top') }}">
        教科書販売
    </a>

    <form method="get" action="{{ route('textbooks.index') }}" class="c-header-form">
        <div class="c-header-form__content">
            <div class="c-header-form__search">
                <div class="c-header-form__box">
                    <input name="keyword" class="c-header-form__input js-toggle__trigger js-header-input"
                        placeholder="キーワードを入力" autocomplete="off" value="{{ request('keyword') }}">
                    <button class="c-header-form__reset js-reset-button" type="button"
                        style="display: {{ request('keyword') ? 'flex' : 'none' }};">×
                    </button>
                </div>
                <button class="c-header-form__button">検索</button>
                <div class="c-header-form-toggle-wrapper js-toggle__target">
                    <ul class="c-header-form-toggle-wrapper-list">
                        <li class="c-header-form-toggle-wrapper-list-item">
                            <a href="{{ route('university') }}"
                                class="c-header-form-toggle-wrapper-list-item__anchor">詳細検索</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="c-header-form__select">
                <select id="sort" name="sort">
                    <option value="{{ \Constant::SORT_ORDER['recommend'] }}"
                        @if (\Request::get('sort') === \Constant::SORT_ORDER['recommend']) selected @endif>おすすめ順
                    </option>
                    <option value="{{ \Constant::SORT_ORDER['higherPrice'] }}"
                        @if (\Request::get('sort') === \Constant::SORT_ORDER['higherPrice']) selected @endif>料金の高い順
                    </option>
                    <option value="{{ \Constant::SORT_ORDER['lowerPrice'] }}"
                        @if (\Request::get('sort') === \Constant::SORT_ORDER['lowerPrice']) selected @endif>料金の安い順
                    </option>
                    <option value="{{ \Constant::SORT_ORDER['later'] }}"
                        @if (\Request::get('sort') === \Constant::SORT_ORDER['later']) selected @endif>新しい順
                    </option>
                    <option value="{{ \Constant::SORT_ORDER['older'] }}"
                        @if (\Request::get('sort') === \Constant::SORT_ORDER['older']) selected @endif>古い順
                    </option>
                </select>
                <select id="pagination" name="pagination" class="">
                    <option value="5" @if (\Request::get('pagination') === '5') selected @endif>5件
                    </option>
                    <option value="10" @if (\Request::get('pagination') === '10') selected @endif>10件
                    </option>
                    <option value="15" @if (\Request::get('pagination') === '15') selected @endif>15件
                    </option>
                </select>
            </div>
        </div>
    </form>

    <nav class="c-header__navigation" id="navbarSupportedContent">
        {{-- 掲示板遷移ボタン --}}
        @auth
            <a href="{{ route('posts.show') }}" type="submit" class="c-header__chat">
                <i class="fa-regular fa-message"></i>
                <div class="c-header__chat-bottom">チャットを開く</div>
            </a>
        @else
            <div class="c-header__chat">
                <i class="fa-regular fa-message"></i>
                <div class="c-header__chat-bottom c-header__chat-bottom--02">ログインしてください</div>
            </div>
        @endauth
        <ul class="c-header__list">
            @guest
                {{-- 非ログイン --}}
                @foreach ($header_items as $item)
                    <li class="c-header__item">
                        <a class="c-header__link" href="{{ $item['href'] }}" role="button">{{ $item['label'] }}</a>
                    </li>
                @endforeach
            @else
                {{-- ログイン済み --}}
                <li class="c-header__item">
                    {{-- ログイン情報 --}}
                    <a class="c-header__anchor nav-link js-drop-target" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false" v-pre>
                        @if (!empty($user->avatar_file_name))
                            <figure class="c-header__image">
                                <img src="{{ asset('storage/images/' . $user->avatar_file_name) }}">
                            </figure>
                        @else
                            <figure class="c-header__image">
                                <img src="/images/avatar-default.svg">
                            </figure>
                        @endif
                        {{ $user->name }} <span class="caret"></span>
                    </a>
                    <div class="c-header__money">
                        <div class="c-header__money-list">
                            <div class="col">売上金</div>
                            <div class="col-auto">
                                <i class="fas fa-yen-sign"></i>
                                <span class="ml-1">{{ number_format($user->sales) }}</span>
                            </div>
                        </div>
                        <div class="c-header__money-list">
                            <div class="col">出品数</div>
                            <div class="col-auto">{{ number_format($user->soldTextbooks->count()) }} 個</div>
                        </div>
                    </div>
                    <div class="c-header-drop js-drop">
                        <div class="c-header-drop__content" role="none">
                            @foreach ($user_items as $item)
                                <a class="c-header-drop__item" role="menuitem" href="{{ $item['href'] }}"
                                    @if (isset($item['onclick'])) onclick="{{ $item['onclick'] }}" @endif>
                                    <i class="{{ $item['icon'] }}"></i> {{ $item['label'] }}
                                </a>
                            @endforeach

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            @endguest
        </ul>
    </nav>
</header>

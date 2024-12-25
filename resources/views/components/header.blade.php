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
            'label' => 'ログアウト',
            'href' => route('logout'),
            'icon' => 'fas fa-sign-out-alt',
            'onclick' => "event.preventDefault(); document.getElementById('logout-form').submit();",
        ],
    ];
@endphp

<header class="c-header">
    <a class="c-header__logo" href="{{ route('top') }}">
        <img src="/images/logo-1.png" alt="">
    </a>

    <form method="get" action="{{ route('textbooks.index') }}" class="c-header-form">
        <div class="c-header-form__content">
            {{-- <select name="category" class="mb-2 lg:mb-0 lg:mr-2">
                <option value="0" @if (\Request::get('category') === '0') selected @endif>全て</option>
                @foreach ($universities as $university)
                    <optgroup label="{{ $university->name }}">
                        @foreach ($university->faculties as $faculty)
                            <option value="{{ $faculty->id }}" @if (\Request::get('category') == $faculty->id) selected @endif>
                                {{ $faculty->name }}
                            </option>
                        @endforeach
                    </optgroup> <!-- optgroupタグを閉じる -->
                @endforeach
            </select> --}}

            <div class="c-header-form__search">
                <input name="keyword" class="c-header-form__input js-toggle__trigger" placeholder="キーワードを入力" autocomplete="off">
                <button class="c-header-form__button">検索</button>
                <div class="c-header-form-toggle-wrapper js-toggle__target">
                    <ul class="c-header-form-toggle-wrapper-list">
                        <li class="c-header-form-toggle-wrapper-list-item">
                            <a class="c-header-form-toggle-wrapper-list-item__anchor">大学から探す</a>
                        </li>
                        <li class="c-header-form-toggle-wrapper-list-item">
                            <a class="c-header-form-toggle-wrapper-list-item__anchor">学部・学科から探す</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex">
                <div>
                    <span class="text-sm">表示順</span><br>
                    <select id="sort" name="sort" class="mr-4 border-solid border-black">
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
                </div>
                <div>
                    <span class="text-sm">表示件数</span><br>
                    <select id="pagination" name="pagination" class="border-solid border-black">
                        <option value="1" @if (\Request::get('pagination') === '1') selected @endif>1件
                        </option>
                        <option value="2" @if (\Request::get('pagination') === '2') selected @endif>2件
                        </option>
                        <option value="3" @if (\Request::get('pagination') === '3') selected @endif>3件
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </form>

    <nav class="c-header__navigation" id="navbarSupportedContent">
        <ul class="c-header__list">
            @guest
                {{-- 非ログイン --}}
                @foreach ($header_items as $item)
                    <li class="c-header__item">
                        <a class="btn btn-secondary ml-3" href="{{ $item['href'] }}"
                            role="button">{{ $item['label'] }}</a>
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

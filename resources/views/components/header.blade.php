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
        'icon'  => 'far fa-address-card'
    ],
    [
        'label' => '商品を出品する',
        'href' => route('textbooks.create'),
        'icon'  => 'fas fa-camera'
    ],
    [
        'label' => '出品した商品',
        'href' => route('mypage.sold-items'),
        'icon'  => 'fas fa-store-alt'
    ],
    [
        'label' => 'ログアウト',
        'href'  => route('logout'),
        'icon'  => 'fas fa-sign-out-alt',
        'onclick' => "event.preventDefault(); document.getElementById('logout-form').submit();"
    ],
];
@endphp

<header class="c-header">
    <a class="c-header__logo" href="{{route('top')}}">
        <img src="/images/logo-1.png" alt="">
    </a>

    <nav class="c-header__navigation" id="navbarSupportedContent">
        <ul class="c-header__list">
            @guest
                {{-- 非ログイン --}}
                @foreach ($header_items as $item)
                    <li class="c-header__item">
                        <a class="btn btn-secondary ml-3" href="{{ $item['href'] }}" role="button">{{ $item['label'] }}</a>
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

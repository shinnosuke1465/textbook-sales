<header class="c-header">
    <a class="c-header__logo" href="{{ url('/dashboard') }}">
        <img src="/images/logo-1.png" alt="">
    </a>

    <nav class="c-header__navigation" id="navbarSupportedContent">
        <ul class="c-header__list">
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
            @endphp
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
                    <a class="c-header__anchor nav-link js-drop-target" href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
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
                            <!-- アイテム -->
                            <a class="c-header-drop__item" role="menuitem" href="{{ route('mypage.edit-profile') }}">
                                <i class="far fa-address-card"></i> プロフィール編集
                            </a>

                            <a class="c-header-drop__item" role="menuitem" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>ログアウト
                            </a>

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

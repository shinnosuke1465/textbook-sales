@extends('layouts.app')

@section('title')
    プロフィール編集
@endsection

@section('content')
    <section class="pg-profile">
        <div class="row">
            <div class="col-8 offset-2">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="pg-profile__content">
            @include('components.headline_base', [
                'title' => 'プロフィール編集',
            ])

            <form method="POST" action="{{ route('mypage.edit-profile') }}" class="pg-profile-form"
                enctype="multipart/form-data">
                @csrf

                {{-- アバター画像 --}}
                <div class="pg-profile-form__avatar js-userImgPreview">
                    <p class="pg-profile-form__avatar-text">画像</p>
                    <input type="file" name="avatar" class="d-none" accept="image/png,image/jpeg,image/gif"
                        id="avatar" />
                    <label for="avatar" class="pg-profile-form__avatar-image">
                        @include('components.thumbnail', [
                            'type' => 'images',
                            'filename' => $user->avatar_file_name,
                        ])
                    </label>
                </div>

                {{-- ニックネーム --}}
                <div class="pg-profile-form__name">
                    <label for="name">ニックネーム</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @include('components.button_base', [
                'text' => '保存',
                ])
            </form>
        </div>
    </section>
@endsection

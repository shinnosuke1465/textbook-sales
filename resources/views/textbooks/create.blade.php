@extends('layouts.app')

@section('title')
    商品出品
@endsection

@section('content')
    <section class="pg-textbook-create">
        <div class="row">
            <div class="col-8 offset-2">
                {{-- フラッシュメッセージ表示 --}}
                <x-flash-message status="session('status')" />
            </div>
        </div>

        <div class="pg-textbook-create__content">
            @include('components.headline_base', [
                'title' => '商品を出品する',
            ])
            <form method="POST" action="{{ route('textbooks.store') }}" class="pg-textbook-create-form" enctype="multipart/form-data">
                @csrf
                {{-- 商品画像 --}}
                <div class="pg-textbook-create-form__textbook">
                    <p class="pg-textbook-create-form__textbook-text">画像</p>
                    <input type="file" name="textbook"accept="image/png,image/jpeg,image/gif"
                        id="textbook" />
                    <label for="textbook">
                        <div class="pg-textbook-create-form__images js-userImgPreview"></div>
                    </label>
                </div>

                {{-- 商品名 --}}
                <div class="pg-textbook-create-form__name">
                    <label for="name">商品名</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- 商品の説明 --}}
                <div class="pg-textbook-create-form__description">
                    <label for="description">商品の説明</label>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required
                        autocomplete="description" autofocus>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- 大学選択 --}}
                <div class="pg-textbook-create-form__university">
                    <label for="university_id" class="leading-7 text-sm text-gray-600">大学</label>
                    <select name="university_id" id="university_id" class="@error('university_id') is-invalid @enderror">
                        <option value="">選択してください</option>
                        @foreach ($universities as $university)
                            <option value="{{ $university->id }}"
                                {{ old('university') == $university->id ? 'selected' : '' }}>
                                {{ $university->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('university_id')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- 学部選択 --}}
                <div class="pg-textbook-create-form__faculty">
                    <label for="faculty_id" class="leading-7 text-sm text-gray-600">学部</label>
                    <select name="faculty_id" id="faculty_id" class="@error('faculty_id') is-invalid @enderror">
                    </select>
                    @error('faculty_id')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- 商品の状態 --}}
                <div class="pg-textbook-create-form__condition">
                    <label for="condition">商品の状態</label>
                    <select name="condition" class="custom-select form-control @error('condition') is-invalid @enderror">
                        @foreach ($conditions as $condition)
                            <option value="{{ $condition->id }}"
                                {{ old('condition') == $condition->id ? 'selected' : '' }}>
                                {{ $condition->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('condition')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- 販売価格 --}}
                <div class="pg-textbook-create-form__price">
                    <label for="price">販売価格</label>
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror"
                        name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                    @error('price')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @include('components.button_base', [
                'text' => '出品する',
                'type' => 'create'
                ])
            </form>
        </div>
    </section>
@endsection

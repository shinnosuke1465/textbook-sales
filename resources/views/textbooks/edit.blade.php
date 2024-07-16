@extends('layouts.app')

@section('title')
    商品編集
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
                'title' => '商品を編集する',
            ])
            <form method="POST" action="{{ route('textbooks.update', $textbook->id) }}" class="pg-textbook-create-form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- 商品画像 --}}
                <div class="pg-textbook-create-form__textbook">
                    <p class="pg-textbook-create-form__textbook-text">画像</p>
                    <input type="file" name="textbook_image"accept="image/png,image/jpeg,image/gif" id="textbook" />
                    <label for="textbook">
                        <div class="pg-textbook-create-form__images js-userImgPreview">
                            @if ($textbook->image_file_name)
                                <figure class="pg-textbook-create-form__image">
                                    <img src="{{ asset('storage/textbooks/' . $textbook->image_file_name) }}"
                                        class="img-thumbnail" />
                                </figure>
                            @endif
                        </div>
                    </label>
                </div>

                {{-- 商品名 --}}
                <div class="pg-textbook-create-form__name">
                    <label for="name">商品名</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ $textbook->name }}" required autocomplete="name" autofocus>
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
                        autocomplete="description" autofocus>{{ $textbook->description }}</textarea>
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
                                {{ old('university', $textbook->university->id ?? '') == $university->id ? 'selected' : '' }}>
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
                                {{ old('university', $textbook->condition->id ?? '') == $condition->id ? 'selected' : '' }}>
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
                        name="price" value="{{ $textbook->price }}" required autocomplete="price" autofocus>
                    @error('price')
                        <span class="invalid-feedback text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @include('components.button_base', [
                    'text' => '変更する',
                    'type' => 'edit',
                ])
            </form>


            <form id="delete_{{ $textbook->id }}" method="post" action="{{ route('textbooks.destroy', $textbook->id) }}">
                @csrf
                @method('delete')
                @include('components.button_base', [
                    'text' => '削除する',
                    'type' => 'delete',
                ])
            </form>
        </div>
    </section>
@endsection

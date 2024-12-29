@extends('layouts.app')

@section('title')
    掲示板
@endsection

@section('content')
    <div class="pg-post">
        @include('components.headline_base', [
            'title' => '掲示板',
        ])
        <div class="pg-post-inner container mx-auto">
            <h1 class="text-3xl font-bold mt-4 mb-2 text-center">掲示板</h1>
            @foreach($posts as $post)
                <div class="border-gray-300 border-b-2 mb-2">{{$post->created_at}} <span class="text-green-500">匿名さん</span></div>
                <div class="mt-2 p-4 py-0">{{$post->comment}}</div>
            @endforeach
            <form method="POST">
                @csrf <!-- CSRF トークン -->
                <div>
                    <label for="comment">コメント</label>
                    <textarea name="comment" rows="3" required class="border mt-4 mb-4 p-4 w-full"></textarea>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded">コメントする</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection

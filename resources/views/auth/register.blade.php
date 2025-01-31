<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- 大学選択 --}}
        <label for="university_id" class="leading-7 text-sm text-gray-600">大学</label>
        <select required name="university_id" id="university_id"
            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            <option value="">選択してください</option>
            @foreach ($universities as $university)
                <option value="{{ $university->id }}" {{ old('university') == $university->id ? 'selected' : '' }}>
                    {{ $university->name }}
                </option>
            @endforeach
            <option value="__other__">その他（新規追加）</option>
        </select>
        {{-- 大学名を手動入力する欄（デフォルト非表示） --}}
        <div class="mt-2" id="new_university_wrapper" style="display: none;">
            <input autocomplete="off" class="w-full" type="text" name="new_university" id="new_university" placeholder="新しい大学名を入力"
                value="{{ old('new_university') }}">
        </div>
        <x-input-error :messages="$errors->get('new_university')" class="mt-2" />

        {{-- 学部選択 --}}
        <label for="faculty_id" class="leading-7 text-sm text-gray-600">学部</label>
        <select required name="faculty_id" id="faculty_id"
            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        </select>

        {{-- 学部名を手動入力する欄（デフォルト非表示） --}}
        <div class="mt-2" id="new_faculty_wrapper" style="display: none;">
            <input autocomplete="off" class="w-full" type="text" name="new_faculty" id="new_faculty" placeholder="新しい学部名を入力"
                value="{{ old('new_faculty') }}">
        </div>
        <x-input-error :messages="$errors->get('new_faculty')" class="mt-2" />

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

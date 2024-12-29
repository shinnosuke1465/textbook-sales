<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\University;
use App\Models\Faculty;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        //大学とそれに紐づく学部を取得
        $universities = University::with('faculties')->get();
        return view('auth.register', compact('universities'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // バリデーションルール
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'new_university' => ['nullable', 'regex:/.*大学$/', 'unique:universities,name'],
            'new_faculty' => [
                'nullable',
                'regex:/.*学部$/', // 「学部」で終わる形式を確認
                'unique:faculties,name,NULL,id,university_id,' . $request->input('university_id'), // 選択した大学内でユニークかチェック
            ],
        ]);

        // 1) 大学IDの処理
        $universityId = $request->input('university_id');
        if ($universityId === '__other__') {
            $newUniversityName = $request->input('new_university');

            // 新しい大学名がバリデーション済みなのでここでは追加チェック不要
            $university = University::create(['name' => $newUniversityName]);
            $universityId = $university->id;
        }

        // 2) 学部IDの処理
        $facultyId = $request->input('faculty_id');
        if ($facultyId === '__other__') {
            $newFacultyName = $request->input('new_faculty');

            // 学部が既に存在している場合はエラーを返す
            if (Faculty::where('name', $newFacultyName)->where('university_id', $universityId)->exists()) {
                return redirect()->back()->withErrors(['new_faculty' => 'この学部は既に登録されています。']);
            }

            $faculty = Faculty::create([
                'name' => $newFacultyName,
                'university_id' => $universityId,
            ]);
            $facultyId = $faculty->id;
        }

        // 3) ユーザ作成
        $user = User::create([
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'password'      => Hash::make($request->input('password')),
            'university_id' => $universityId,
            'faculty_id'    => $facultyId,
        ]);

        event(new Registered($user));
        Auth::login($user);

        //掲示板作成
        $post = Post::where('university_id', $user->university_id)
            ->where('faculty_id', $user->faculty_id)
            ->first();

        if (! $post) {
            $post = Post::create([
                'university_id' => $user->university_id,
                'faculty_id'    => $user->faculty_id,
                'title'         => "{$user->university->name}×{$user->faculty->name}",
            ]);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}

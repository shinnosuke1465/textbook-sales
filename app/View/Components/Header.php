<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\University;

class Header extends Component
{
    public $universities;
    public $user;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // universities テーブルと faculties リレーションを取得
        $this->universities = University::with('faculties')->get();

        // 現在の認証済みユーザーを取得
        $this->user = Auth::user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}

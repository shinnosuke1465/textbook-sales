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

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // universities テーブルと faculties リレーションを取得
        $this->universities = University::with('faculties')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user = Auth::user();

     //以下のコードを追加
       return view('components.header')
           ->with('user', $user);
    }
}

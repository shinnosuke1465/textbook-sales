<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoughtItemsController extends Controller
{
    public function showBoughtItems()
    {
        $user = Auth::user();

        $items = $user->boughtTextbooks()->orderBy('id', 'DESC')->get();

        return view('mypage.bought_items')
            ->with('items', $items);
    }
}

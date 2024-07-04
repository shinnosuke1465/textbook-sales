<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldItemsController extends Controller
{
    public function showSoldItems()
    {
        //ログインしているユーザーが出品した商品を取得
        $user = Auth::user();

        //ログインしているユーザーに紐づく出品した商品を取得
            // orderBy('id', 'DESC')...idを降順(大きい順)で並べる
        $items = $user->soldTextbooks()->orderBy('state', 'DESC')->orderBy('id', 'DESC')->get();

        return view('mypage.sold_items')->with('items', $items);
    }
}

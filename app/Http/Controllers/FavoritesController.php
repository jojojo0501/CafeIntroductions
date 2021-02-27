<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($id)
    {
        // 認証済みのユーザーが$introductionIdのintroductionをお気に入り登録する
        \Auth::user()->favorite($id);
        return back();
    }
    
    public function destroy($id)
    {
        // 認証済みのユーザーが$introductionIdのintroductionをお気に入り解除する
        \Auth::user()->unfavorite($id);
        return back(); 
    }
}

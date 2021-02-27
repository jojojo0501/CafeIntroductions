<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store($id)
    {
        // 認証済みのユーザーがidのユーザーをフォローする
        \Auth::user()->follow($id);
        // 前のページへリダイレクトさせる
        return back();
    }
    
    public function destroy($id)
    {
        // 認証済みのユーザーがidのユーザーをフォローする
        \Auth::user()->unfollow($id);
        // 前のページへリダイレクトさせる
        return back();
    }
}

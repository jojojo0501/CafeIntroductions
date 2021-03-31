<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class IntroductionsController extends Controller
{
    public function index(){
        $data = [];
         if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザとフォロー中のユーザーの投稿の一覧を作成日時の降順で取得
            $introductions = $user->feed_introductions()->with('comments')->orderBy('created_at', 'desc')->paginate(10);
             $data = [
                'user' => $user,
                'introductions' => $introductions,
            ];
         }

         // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    
    public function create()
    {
        //投稿画面へ
        return view('introductions.create');
    }
    
       public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:200',
            'file' => 'image|max:3000',
        ]);
    
        if ($request->hasFile('introduction_photo_path')){
         //s3アップロード開始
        $introduction_photo_path=$request->file('introduction_photo_path');
         // バケットの`introudctions`フォルダへアップロード
         $path = Storage::disk('s3')->putFile('introductions', $introduction_photo_path, 'public');
         
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
            $request->user()->introductions()->create([
            'content' => $request->content,
            'introduction_photo_path' => Storage::disk('s3')->url($path)
        ]);
        }else{
            
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->introductions()->create([
            'content' => $request->content,
        ]);
        }

        //トップページへリダイレクトさせる
        return redirect('/');
    } 
    
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $introduction = \App\Introduction::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $introduction->user_id) {
            $introduction->delete();
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
}

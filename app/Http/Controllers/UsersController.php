<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\User;
use Storage;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);
        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
     public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザの投稿一覧を作成日時の降順で取得
        $introductions = $user->introductions()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'introductions'=> $introductions,
        ]);
    }
    
    public function edit($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
         return view('users.edit', [
            'user' => $user,
        ]);
    }
    
    private const GUEST_USER_ID = 1;
  
    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id); 
         if($user->id == 1){
        return redirect('/');
         }else{
                $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'file' => 'image|max:2048',
            ]);
        $user->name =$request->name;
        $user->email =$request->email;
         }
        
        if ($request->hasFile('profile_photo_path')){
            //s3アップロード開始
            $profile_photo_path= $request->file('profile_photo_path');
            // バケットの`introudctions`フォルダへアップロード
            $path = Storage::disk('s3')->putFile('introductions', $profile_photo_path, 'public');
            $user->profile_photo_path= Storage::disk('s3')->url($path);
        }
            $user->save();
            //トップページへリダイレクトさせる
            return redirect('/');
        
        
    }
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    public function favorites($id)
    {
        //idの値でユーザーを検索して取得
        $user = User::findOrFail($id);
        
        //関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        //ユーザーがお気に入り登録しているintroduction一覧を取得
        $introductions = $user->favorites()->paginate(10);
        //お気に入り一覧ビューでそれらを表示
        return view("users.favorites",[
        "user"=>$user,
        "introductions"=>$introductions
        ]);
    }
    
}

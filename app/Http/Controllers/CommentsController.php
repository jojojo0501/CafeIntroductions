<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{   
        public function create($id)
    {
        $introduction = \App\Introduction::findOrFail($id);
        //投稿画面へ
        return view('comments.create',['introduction'=>$introduction]);
    }
    
        public function store(Request $request,$id)
    {
        
        $request->validate([
        'content' => 'required|max:200',
        ]);
       // フォームから送信された値でコメントを作成
        $comment = new Comment;
        $comment->content = $request->content;
        $comment->user_id = $request->user()->id; // ここは \Auth::id() でも良い
        $comment->introduction_id = $id;
        $comment->save();
        return redirect('/');
    }

    
 
    
    public function destroy($id)
    {
        $comment =Comment::findOrFail($id);
        // コメントを削除
        $comment->delete();
        return redirect('/');
    }     
        
}

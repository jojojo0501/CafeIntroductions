<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
     /**
     * このユーザが所有する投稿。（ Introductionモデルとの関係を定義）
     */
    public function introductions()
    {
        return $this->hasMany(Introduction::class);
    }
    
    /**
     * このユーザがフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    /**
     * このユーザをフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    
    public function follow($userId)
    {
        // 既にフォローしているかの確認
        $exist =$this->is_following($userId);
        // 対象が自分かどうかの確認
        $its_me = $this->id == $userId;
        if ($exist || $its_me) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
     public function unfollow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            // すでにフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
    
     public function is_following($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function feed_introductions()
    {
        // このユーザーがフォロー中のユーザーのidを取得して配列にする
        $userIds = $this->pluck("users.id")->toArray();
        // このユーザーのidもその配列に追加
        $userIds[] =$this->id;
        //それらのユーザーが所有する投稿に絞り込む
        return Introduction::whereIn('user_id', $userIds);
    }

    public function favorites()
    {
        // このユーザーのお気に入り投稿
        return $this->belongsToMany(Introduction::class,'favorites','user_id','introduction_id')->withTimestamps();
    }
    
    public function is_favorite($introductionId)
    {
        // お気に入り追加しているものに、$introductionIdのものが存在するか
        return $this->favorites()->where('introduction_id',$introductionId)->exists();
    }
    
    public function favorite($introductionId)
    {
        // 既にお気に入り登録しているかの確認
        $exist = $this->is_favorite($introductionId);
        if ($exist){
            // 既にお気に入り追加していれば何もしない
            return false;
        }else{
            // お気に入り登録していなければ登録する
            $this->favorites()->attach($introductionId);
            return true;
        }
        
    }
    
    public function unfavorite($introductionId)
    {
        // 既にお気に入り登録しているかの確認
        $exist = $this->is_favorite($introductionId);
        if ($exist){
            // 既にお気に入り追加していればお気に入りを外す
            $this->favorites()->detach($introductionId);
        }else{
            // お気に入り登録していなければ何もしない
            return false; 
     }
    }
    
        public function commenting() {
         return $this->hasMany(Comment::class, 'id');
    }
    
         /**
     * このユーザに関係するモデルの件数をロードする。
     */
     public function LoadRelationshipCounts()
     {
         $this->loadCount("introductions","followings","followers","favorites");
    }
    
    //     public function comment($introduction_id)
    // {
    //     $comments = $this->commenting;
    //     $content='';
    //     foreach($comments as $comment){
    //      $content = $comment->content;
    //     }
    //     // コメントする
    //     $this->commenting()->attach($introduction_id,['content'=>$content]);
    // }
        
    
    
    // public function uncomment($introduction_id)
    // {
    //         // 既にお気に入り追加していればお気に入りを外す
    //         $this->commenting()->detach($introductionId);
    // }
    //     public function commentt() {
    //      $this->hasMany(Comment::class);
    // }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Introduction extends Model
{
    protected $fillable = ['content','introduction_photo_path', 'prefectures','municipalities'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favorite_users()
    {
        // このユーザーのお気に入り投稿
        return $this->belongsToMany(User::class,'favorites','introduction_id','user_id')->withTimestamps();
    }
    
    //     public function commented()
    // {
    //     //この投稿にコメントしたユーザー
    //      return $this->belongsToMany(User::class,'comments','introduction_id','user_id')->withTimestamps();
    // }
    
    public function comments() {
         return $this->hasMany(Comment::class, 'introduction_id');
    }
    
}

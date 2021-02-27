<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
     protected $fillable = [
        'content', 'user_id','introduction_id'
   ];
   
       public function introductions() {
        return $this->belongsTo(Introduction::class);
    }
    
       public function user() {
        return $this->belongsTo(User::class);
    }

   
   
    //       public function commenting()
    // {
    //      return $this->belongsTo(Introduction::class)->withTimestamps();
    // }
    
    //       public function commented()
    // {
    //     //この投稿にコメントしたユーザー
    //      return $this->belongsTo(User::class)->withTimestamps();
    // }
    
}

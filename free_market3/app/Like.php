<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $fillable = ['user_id', 'item_id'];


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function Item() {
        return $this->belongsTo('App\Item');
    }

    // いいねが既にされているか確認
    public function like_exist($user_id, $item_id) {
        
        //Likeテーブルのレコードにuser_id と item_id が一致するものを取得
        $exist = Like::where('user_id', '=', $user_id)->where('item_id', '=', $item_id)->get();

        if(!$exist->isEmpty()) {
            return true;
        } else {
            return false;
        }
    }

}

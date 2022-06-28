<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'user_id', 'name', 'description', 'price', 'category_id', 'image'
    ];

    //
    public function user() {
        return $this->belongsTo('App\User');
    }

    //
    public function category() {
        return $this->belongsTo('App\Category');
    }

    //
    public function orders() {
        return $this->hasMany('App\Order');
    }

    //
    public function likes() {
        return $this->hasMany('App\Like');
    }

    // お気に入りユーザー取得
    public function LikeUsers() {
        return $this->belongsToMany('App\User', 'likes');
    }

    // 商品が購入されているか確認
    public function isOrderBy($item) {
        $order_item_ids = Order::all()->pluck('item_id');
        $result = $order_item_ids->contains($item->id);
        return $result;
    }

    // 出品者の名前を取得
    public function getUserName($user_id)
    {
        // User モデルに対して where 文で絞り込みをかける。
        // where('カラム名','比較演算子','第一引数のカラム名に対する値')
        return User::where('id', '=', $user_id)->first();
    }

    // // 商品がいいねされているか確認
    // public function isLikedBy($user) {
    //     $liked_user_ids = $this->likedUsers->pluck('id');
    //     $result = $liked_user_ids->contains($user->id);
    //     return $result;
    // }

    public function likedBy($user) {
        //Like モデルに接続、user_id で Likeモデル内に検索をかける、さらにitem_id で検索を絞り込む
        return Like::where('user_id', $user->id)->where('item_id', $this->id);
    }
}

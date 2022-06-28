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
        'name', 'email', 'password', 'profile', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //
    public function items() {
        return $this->hasMany('App\Item');
    }

    //
    public function orders() {
        return $this->hasMany('App\Order');
    }

    // 自分が購入した商品を取得
    public function orderItems() {
        return $this->belongsToMany('App\Item', 'orders');
    }

    // Likeリレーション設定
    public function likes() {
        return $this->hasMany('App\Like');
    }

    // 自分がいいねした商品を取得
    public function likeItems() {
        return $this->belongsToMany('App\Item', 'Likes');
    }

}

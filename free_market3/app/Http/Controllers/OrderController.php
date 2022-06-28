<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Category;
use App\Order;

class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function confirm(Item $item) {
        return view('orders.confirm', [
            'title' => '購入内容確認',
            'item' => $item,
        ]);
    }

    //
    public function store_confirm(Item $item) {

        Order::create([
            'user_id' => \Auth::user()->id,
            'item_id' => $item->id,
        ]);

        return redirect()->route('items.finish', $item);
    }

    // 
    public function finish(Item $item) {
        return view('orders.finish', [
            'title' => 'ご購入ありがとうございました！',
            'item' => $item,
        ]);
    }
}

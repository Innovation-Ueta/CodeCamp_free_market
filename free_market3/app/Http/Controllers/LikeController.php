<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    //
    public function index() {

        $user = \Auth::user();
        $like_items = $user->likeItems()->orderBy('likes.created_at', 'desc')->get();
        return view('likes.index', [
            'title' => 'いいね一覧',
            'like_items' => $like_items
        ]);
    }

    //
    // public function store(Request $request) {

    // }


    // public function store(Request $request) {

    //     //$requestの中身を確認
    //     // dd($request->teet_id);
    //     $like = new Like;
    //     $like->item_id = $request->item_id;
    //     $like->user_id = Auth::user()->id;
    
    //     $like->save();
    
    //     return redirect('/');
    // }

    // //
    // // public function destroy($id) {

    // // }

    // public function destroy(Request $request) {

    //     $like = Like::find($request->like_id);
    //     $like->delete();
    //     return redirect('/');
    // }

    public function isLike(Request $request) {
        dd($request);
        $item_id = $request->id;
        $user_id = Auth::user()->id;
        $like = Like::where('item_id', $item_id)->where('user_id', $user_id);


        if ($like->exists()) {
            $like->first()->delete();
            return 'delete';
        } 

        Like::create([
            'item_id' => $item_id,
            'user_id' => $user_id,
        ]);
        return 'create';

        
    }
}

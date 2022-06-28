<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Like;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Requests\ItemImageRequest;

use App\Services\FileUploadService;
use App\User;

class ItemController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 祈祷のユーザーに紐づく投稿の一覧を取得
        // $items = Item::where('user_id', \Auth::user()->id)->get();
        $user = \Auth::user();
        $items = Item::latest('updated_at')->paginate(3); //->whereNotIn('user_id', [$user->id]) 自分以外、whereIn、where の違いを調べる！
        $like_model = new Like;

        //
        return view('items.index', [
            'title' => '商品一覧',
            'items' => $items,
            'like_model' => $like_model,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // pluckメソッド pluck('バリュー','キー') を取得することができる。
        $categories = Category::pluck('name', 'id');
        // dd($categories);
        $users_name = User::pluck('name', 'id');
        // dd($users_name);

        return view ('items.create',[
            'title' => '登録',
            'categories' => $categories,
            'users_name' => $users_name
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request, FileUploadService $service)
    {
        // 画像処理
        $path = $service->saveImage($request->file('image'));
        // $image = $request->file('image');
        $user = \Auth::user();


        // 投稿処理
        Item::create([
            'user_id' => $user->id,
            'user_name' => $user->user_name, //？？？
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category, //create.blade.php の name属性と同じにせなあかん！
            'image' => $path,
        ]);

        session()->flash('success', '投稿を追加しました！');
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
        $category = Category::where('id', $item->id)->first();
        return view('items.show', [
            'title' => '商品詳細',
            'item' => $item,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
        // $categories = Category::all();
        $categories = Category::pluck('name', 'id');
        // $item = Item::find($id);

        //
        return view('items.edit', [
            'title' => '商品情報編集',
            'categories' => $categories,
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
        $item = Item::find($item->id);
        //$item->update($request->only(['name', 'description', 'price', 'category_id']));
        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category
        ]);

        session()->flash('success', '商品を編集しました。');
        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        // $item = Item::find($id);
        // $item->delete();

        //
        if($item->image !== '') {
            \Storage::disk('public')->delete($item->image);
        }

        // \Session::flash('success', '投稿を削除しました。');
        $item->delete();
        session()->flash('success', '商品を編集しました。');
        return redirect()->route('items.index');
    }

    //
    public function edit_image(Item $item) {

        return view('items.edit_image', [
            'title' => '画像変更',
            'item' => $item,
        ]);
    }


    //画像を更新
    // storages ディレクトリを作成してしまったから、「画像削除」のとこの処理が違うのでは？
    public function update_image(ItemImageRequest $request, Item $item, FileUploadService $service) {
        //
        $path = $service->saveImage($request->file('image'));
        // $image = $request->file('image');

        if($path !== '' && $item->image !== '') {
            // 前の画像を削除
            \Storage::disk('public')->delete($item->image);
        }

        $item->update([
            'image' => $path
        ]);

        session()->flash('success', '画像を変更しました。');
        return redirect()->route('items.index');
    }

    //
    public function exhibitions() {

        $user = \Auth::user();
        $categories = Category::get();
        $user_items = Item::latest('updated_at')->where('user_id', $user->id)->get();

        return view('items.exhibitions', [
            'title' => '出品商品一覧',
            'items' => $user_items,
            'categories' => $categories,
        ]);
    }

    // いいね処理
    // public function toggleLike(Item $item) {
        
    //     $user = \Auth::user();
        
    //     if ($item->isLikedBy($user)) {
    //         // お気に入り取り消し
    //         $item->likes->where('user_id', $user->id)->first()->delete();
    //         session()->flash('success', 'お気に入りを取り消しました');
    //     } else {
    //         // お気に入り取り
    //         Like::create([
    //             'user_id' => $user->id,
    //             'item_id' => $item->id,
    //         ]);
    //         session()->flash('success', 'お気に入りに登録しました');
    //     }
        
    //     return redirect(route('items.index'));
    // }


    //
    public function ajaxlike(Request $request) {

        $user_id = Auth::user()->id;
        $item_id = $request->id;
        $like = new Like;
        $item = Item::findOrFail($item_id);

        if ($like->like_exist($user_id, $item_id)) {
            
            $like = Like::where('item_id', $item_id)->where('user_id', $user_id)->delete();
        } else {

            $like = new Like;
            $like->id = $request->id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        $itemLikesCount = $item->loadCount('likes')->likes_count;

        $json = [
            'itemLikesCount' => $itemLikesCount,
        ];

        return response()->json($json);
    }
    
}
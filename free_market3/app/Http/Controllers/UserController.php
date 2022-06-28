<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;

// 画像保存サービスクラス読み込み
use App\Services\FileUploadService;

class UserController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = \Auth::user();
        return view('users.show', [
            'title' => 'プロフィール詳細',
            'user' => $user,
            'orders' => $user->orderItems()->get()
        ]);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $user = \Auth::user();
        return view('users.edit', [
            'title' => 'プロフィール編集',
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        //
        $user = \Auth::user();

        $user->update([
            'name' => $request->name,
            'profile' => $request->profile
        ]);

        session()->flash('success', 'プロフィールを更新しました');
        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //
    public function edit_image() {

        $user = \Auth::user();
        return view('users.edit_image', [
            'title' => 'プロフィール画像編集',
            'user' => $user,
        ]);
    }

    //
    public function update_image(UserImageRequest $request, FileUploadService $service) {
        // dd($request->image);
        $path = $service->saveImage($request->image);
        // dd($path);
        $user = \Auth::user();

        if($path !== '' && $user->avatar !== '') {
            //前の画像を削除
            \Storage::disk('public')->delete($user->avatar);
        }
        $user->update([
            'avatar' => $path
        ]);

        session()->flash('success', 'プロフィールを変更しました。');
        return redirect()->route('users.show', $user->id);

        // return view('users.update_image', [
        //     'title' => 'プロフィール画像更新',
        //     'user' => $user,
        // ]);
    }
}

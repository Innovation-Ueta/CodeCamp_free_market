<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodController extends Controller
{
    //
    public function good(Request $request) {
        $user = Auth::user();
        $good = Good::where('user_id', $user->id)
                ->where('item_id', $request->input('item_id'))->first();

        if($good) {
            $good->delete();
        } else {
            $good = Good::create([
                'user_id' => $user->id,
                'item_id' => $request->input('item_id')
            ]);
        }

        return response(\Illuminate\Http\Response::HTTP_OK);
    }
}

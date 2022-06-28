@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>

  <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="" name="user_name" >出品者： {{ \Auth::user()->name }}さん</label>
    </div>

    <div>
      <label>
        商品名：
        <input type="text" name="name">
      </label>
    </div>

    <div>
      <label>
        商品説明：
        <textarea name="description" id="" cols="30" rows="10"></textarea>
      </label>
    </div>
      
    <div>
      <label>
        価格：
        <input type="text" name="price" id="price">
      </label>
    </div>
      
    <div>
      <label>
        カテゴリー：
        {{-- {{ dd($categories) }} --}}
        {{--
        ItemController create アクションで $categories を設定済み
        $categories には、以下の情報が格納されている
        "id" => 1
        "name" => "hoge"
        "created_at" => null
        "updated_at" => null 
        --}}
        <select name="category" id="category" required>
          @foreach ($categories as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
          @endforeach
          
        </select>
      </label>
    </div>
      
    <div>
      <label>
        画像：
        <input type="file" name="image">
      </label>
    </div>

    <input type="submit" value="出品">
  </form>
@endsection
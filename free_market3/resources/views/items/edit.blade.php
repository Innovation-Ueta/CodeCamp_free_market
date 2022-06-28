@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <form action="{{ route('items.update', $item) }}" method="POST">
    @csrf
    @method('patch')

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
        <input type="text" name="price" id="">
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
        <select name="category_id" id="">
          @foreach ($categories as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
          @endforeach
          
        </select>
      </label>
    </div>

    <input type="submit" value="更新">
  </form>
@endsection
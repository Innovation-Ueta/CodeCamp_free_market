@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>

  <div>
    <div class="inner-box">
      <h2>商品名</h2>
      <p>{{ $item->name }}</p>

      <h2>画像</h2>
      <div>
        @if($item->image !== '')
          <img src="{{ asset('storages/storage/' . $item->image) }}">
        @else
          <img src="{{ aseet('images/no_image.png') }}">
        @endif
      </div>

      <h2>カテゴリー</h2>
      <p>{{ $item->category->name }}</p>

      <h2>価格</h2>
      <p>{{ $item->price }}</p>

      <h2>説明</h2>
      <p>{{ $item->description }}</p>

      <form action="{{ route('items.store_confirm', $item) }}" method="POST">
        @csrf
        @method('patch')
        <input type="submit" value="購入する">
      </form>
    </div>
  </div>

@endsection
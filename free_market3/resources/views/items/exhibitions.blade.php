@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>

  <div>
    <ul>
      @forelse ($items as $item)
        {{-- {{ dd($item) }} --}}
        <li>
          <div class="media_box">
            <a href="{{ route('items.show', $item) }}">
              @if ($item->image !=='')
              <img src="{{ asset('storages/storage/' . $item->image) }}">
              @else
                  <img src="{{ asset('images/no_image.png') }}" alt="">
              @endif
            </a>
          </div>
            
          <div>
            <h3>商品名: {{ $item->name }}</h3>
            <p>商品説明: {{ $item->description }}</p>
            <p>カテゴリー: {{ $item->category->where('id', $item->category_id)->first()->name }}</p>
            <p>更新時刻: {{ $item->updated_at }}</p>
          </div>

          <div>
            <p>{{ $item->isOrderBy($item) ? '売り切れ' : '出品中' }}</p>
            <div>
              <p>{{ $item->price }}円</p>
            </div>
          </div>
        </li>
      @empty
          <li>商品がありません</li>
      @endforelse
    </ul>
  </div>
@endsection
@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>{{ $title }}</h1>
    {{-- {{ dd($like_items) }} --}}
    <div>
        <ul>
          @forelse($like_items as $like_item)
            <li class="item_box">

              <div class="meda_box">
                <a href="{{ route('items.show', $like_item) }}">
                  @if($like_item->image !== '')
                    <img src="{{ 'storages'.Storage::url($like_item->image) }}" alt="">
                  @else
                    <img src="{{ asset('images/no_image.png') }}" alt="">
                  @endif
                </a>
              </div>

              <div>
                <h3>商品名：{{ $like_item->name }}</h3>
                <p>商品説明：{{ $like_item->description }}</p>
                <p>カテゴリー：{{ $like_item->category->where('id', $like_item->category_id)->first()->name }}</p>
              </div>

              <div>
                <p>{{ $like_item->isOrderBy($like_item) ? '売り切れ' : '出品中' }}</p>
                <div>
                  <p>{{ $like_item->price }}円</p>
                </div>
              </div>
              
            </li>
          @empty
            <li>商品がありません</li>
          @endforelse
        </ul>
    </div>
@endsection
@extends('layouts.logged_in')

@section('title', $title)
    
@section('content')
<div>
    <div class="inner_box">
        <h1>{{ $title }}</h1>
        <h2>商品名</h2>
        
        <p>{{ $item->name }}</p>

        <h2>画像</h2>
        <div class="media_box">
            @if ($item->image !== '')
                {{-- <img src="{{ asset('storages/storage/' . $item->image) }}"> --}}
                <img src="{{ asset('storages/storage/' . $item->image) }}">
            @else
                <img src="{{ asset('images/no_image.png') }}" alt="">
            @endif
        </div>
        
        <h2>カテゴリー</h2>
        <p>{{ $item->category->name }}</p>

        <h2>価格</h2>
        <p>{{ $item->price }}</p>

        <h2>説明</h2>
        <p>{{ $item->description }}</p>
        @if ($item->isOrderBy($item))
            <p>売り切れ！</p>
        @else
            <a href="{{ route('items.confirm', $item) }}">
                <button>購入する</button>
            </a>
        @endif
    </div>
</div>
@endsection
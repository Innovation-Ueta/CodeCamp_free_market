@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <a href="{{ route('items.create') }}">新規出品</a>
  {{-- {{ dd($items) }} --}}
  {{-- {{ dd($user) }} --}}
  
  {{-- 価格、カテゴリー等で絞り込めるようにする（submit） --}}
  BootStorap無料テンプレート、Adomin

  <ul class="items">
    @forelse ($items as $item)
    {{-- {{ dd($item) }} --}}
        <li class="item">
          <div class="item_content">
            
            <div class="item_body">
              <div class="item_body_heading">
                <h3>商品名：{{ $item->name }} </h3>
                <p>商品説明：{{ $item->description }}</p>
                <p>カテゴリー：{{ $item->category->where('id', $item->category_id)->first()->name }}</p>
                <p>更新時刻：（{{ $item->updated_at }}）</p>
                {{-- 出品者を取得するには紐づくメソッドを作成する必要がある→Item.php --}}
                <p>出品者: {{ $item->getUserName($item->user_id)->name }}</p>
              </div>

              <div class="item_body_main">
                <a href="{{ route('items.show', $item) }}">
                  <div class="item_body_main_img">
                    @if ($item->image !== '')
                      {{-- <img src="{{ asset('storages/storage/' . $item->image) }}"> --}}
                      <img src="{{ 'storages'.Storage::url($item->image) }}" alt="">
                    @else
                      <img src="{{ asset('images/no_image.png') }}" alt="">
                    @endif

                    <a href="{{ route('items.edit_image' , $item) }}">画像を変更</a>
                  </div>
                </a>

                <div class="item_body_main_comment">
                  {{ $item->description }}
                </div>
              </div>

            </div>
          </div>
          
          [<a href="{{ route('items.edit', $item) }}">編集</a>]

          

          <form class="delete" action="{{ route('items.destroy', $item) }}" method="POST">
            @csrf
            @method('delete')
            <input type="submit" value="削除">
          </form>
        </li>


        <div style="padding: 10px 40px;" class="good">
          {{-- // $tweetのLikedByメソッドを使います。カウント関数を書いてあげる
          // LikedByメソッドをTweet.php で定義 --}}

          {{-- ここをJavaScriptを用いる --}}
          @if($item->likedBy(Auth::user())->count() > 0)
            <div class="js-like-toggle" data-item_id="{{ $item->id }}">
              <i class="far fa-thumbs-down"></i>
            </div>
          @else
            <div class="js-like-toggle loved" data-item_id="{{ $item->id }}">
              <i class="far fa-thumbs-up"></i>
            </div>
          @endif 
          {{-- // like の数をカウント --}}
          {{ $item->likes->count() }}
        </div>
    @empty
        <li>出品はありません</li>
    @endforelse
    {{ $items->links() }}
  </ul>
@endsection
@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  {{-- {{ dd($user) }} --}}
  {{-- {{ dd($orders) }} --}}

  <div class="media_box">
    @if ($user->image !== '')
      {{-- <img src="{{ asset('storages/storage/' . $item->image) }}"> --}}
      <img src="{{ asset('storages/storage/' . $user->avatar) }}" >
    @else
      <img src="{{ asset('images/no_image.png') }}" >
    @endif
  </div>

  <a href="{{ route('profile.edit_image') }}">画像を編集</a>

  <div>
    {{ $user->name }}さん
    <p>{{ $user->profile }}</p>
    <a href="{{ route('profile.edit', $user )}}">プロフィール編集</a>
  </div>
  
  <div>
    <p>出品数：{{ count($orders) }}</p>
  </div>

  <h2>購入履歴</h2>

  <ul>
    @foreach ($orders as $order)
        <li>{{ $order->name }} : {{ $order->price }}円  出品者：{{ $order->user->name }}</li>
    @endforeach
  </ul>

@endsection
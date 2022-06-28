@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>現在の画像</h2>

  @if ($item->image !== '')
      {{-- <img src="{{ \Storage::url($item->image) }}" alt=""> --}}
      <img src="{{ asset('storages/storage/' . $item->image) }}">
  @else
      画像はありません。
  @endif

  <form action="{{ route('items.update_image', $item) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div>
      <label>
        画像を選択：
        <input type="file" name="image" id="image">
      </label>
    </div>

    <input type="submit" value="更新">
  </form>
@endsection